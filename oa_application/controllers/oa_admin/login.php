<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends OA_Controller {

	/**
	 * 
	 * 登录页面
	 */
	public function index()
	{
		$data = array();
		$this->showView('login', $data);
	}
	
	/**
	 * 
	 * 登录处理
	 */
	public function actionLogin()
	{
		
	}
}