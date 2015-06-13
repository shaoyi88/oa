<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * 重定向
 * @param unknown_type $uri
 */
function redirect($uri = '')
{
	header("Location: ".$uri, TRUE, 302);
	exit;
}

/**
 * 
 * 格式化url
 * @param unknown_type $uri
 */
function formatUrl($uri = '')
{
	$ci =& get_instance();
	return base_url().config_item('index_page').'/'.$ci->rtrDir.$uri;
}

/**
 * 
 * 检测登录
 */
function checkLogin()
{
	$ci =& get_instance();
	if($ci->userId == ''){
		if(strtolower($ci->rtrClass) !== 'login'){
			redirect(formatUrl('login/index'));
		}
	}else{
		if(strtolower($ci->rtrClass) === 'login'){
			redirect(formatUrl('home/index'));
		}
	}
}

/**
 * 
 * 检测权限
 * @param unknown_type $key
 */
function checkRight($key)
{
	$ci =& get_instance();
	if($ci->userRights == 'all'){
		return TRUE;
	}else{
		$rightsArr = explode(',', $ci->userRights); 
		if(in_array($key, $rightsArr)){
			return TRUE;
		}
	}
	return FALSE;
}

/**
 * 
 * 分页帮助类
 * @param unknown_type $baseUrl
 * @param unknown_type $totalNum
 * @param unknown_type $perNum
 * @param unknown_type $offset
 * @param unknown_type $pageUrl
 */
function page($baseUrl, $totalNum, $perNum, &$offset, &$pageUrl)
{
	$ci =& get_instance();
	$ci->load->library('pagination');
	$config['base_url'] = $baseUrl;
	$config['total_rows'] = $totalNum;
	$config['per_page'] = $perNum;
	$config['page_query_string'] = TRUE;
	$config['use_page_numbers'] = TRUE;
	$config['num_links'] = 5;
	$config['full_tag_open'] = '<div class="page">';
	$config['full_tag_close'] = '</div>';
	$config['prev_link'] = '&lt;上一页';
	$config['next_link'] = '下一页&gt;';
	$config['first_link'] = '首页';
	$config['last_link'] = '末页';
	$ci->pagination->initialize($config);
	$pageUrl = $ci->pagination->create_links();
	
	$curPage = 1;
	if($ci->input->get('per_page')){
		$curPage = $ci->input->get('per_page');
	}
	$offset = ($curPage-1)*$perNum;
}