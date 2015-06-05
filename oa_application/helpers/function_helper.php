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