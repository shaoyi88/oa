<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends OA_Controller 
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}
	
	/**
	 * 
	 * 主页
	 */
	public function index()
	{
		$data = array();
		$data['userName'] = $this->userName;
		$data['menus'] = $this->config->item('menus');
		$data['admin_id'] = $this->userId;
		$this->showView('index', $data);
	}
	
	/**
	 * 
	 * 退出
	 */
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(formatUrl('login/index'));
	}
	
	/**
	 * 
	 * 欢迎页面
	 */
	public function welcome()
	{
		$data = array();
		$this->showView('welcome', $data);
	}
}