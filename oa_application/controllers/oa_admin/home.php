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
		echo $this->userId;
	}
}