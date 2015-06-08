<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role extends OA_Controller 
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}
	
	/**
	 * 
	 * 权限主页
	 */
	public function index()
	{
		$data = array();
		if(checkRight('role_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$this->load->model('OA_Role');
		$data['dataList'] = $this->OA_Role->getAll();
		$this->showView('roleList', $data);
	} 	
}