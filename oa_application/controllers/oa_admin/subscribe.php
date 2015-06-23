<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscribe extends OA_Controller 
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}
	
	/**
	 * 
	 * 预约首页
	 */
	public function index()
	{
		$data = array();
		if(checkRight('subscribe_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$this->showView('subscribeList', $data);
	}
}