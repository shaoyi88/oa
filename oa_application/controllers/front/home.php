<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends OA_Controller {

	/**
	 * 
	 * 主页面
	 */
	public function index()
	{
		$data = array();
		$data['layout'] = FAlSE;
		$this->showView('index', $data);
	}
}