<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends OA_Controller 
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}	
	
	/**
	 * 
	 * 登录页面
	 */
	public function index()
	{
		$data = array();
		if($this->input->get('msg')){
			$data['msg'] =  $this->input->get('msg');
		}
		$this->showView('login', $data);
	}
	
	/**
	 * 
	 * 登录处理
	 */
	public function actionLogin()
	{
		if(($userAccount = $this->input->post('userAccount', TRUE)) === FALSE){
			redirect(formatUrl('login/index?msg='.urlencode('请填写账户')));
		}
		if(($userPassword = $this->input->post('userPassword', TRUE)) === FALSE){
			redirect(formatUrl('login/index?msg='.urlencode('请填写密码')));
		}
		$this->session->set_userdata('uid', $userAccount);
		redirect(formatUrl('home/index'));
	}
}