<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends OA_Controller 
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}
	
	/**
	 * 
	 * 用户首页
	 */
	public function index()
	{
		$data = array();
		if(checkRight('user_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		
		if($this->input->post('keyword')){
			
		}else{
			$this->load->model('OA_User');
			$offset = 0;
			$pageUrl = '';
			page(formatUrl('user/index').'?', $this->OA_User->getUserCount(), PER_COUNT, $offset, $pageUrl);
			$dataList = $this->OA_User->getUser($offset, PER_COUNT);
			$data['pageUrl'] = $pageUrl;
			
		}
		$data['dataList'] = $dataList;		
		$this->showView('userList', $data);
	}
}