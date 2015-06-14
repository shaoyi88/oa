<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Areas extends OA_Controller 
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}
	
	/**
	 * 
	 * 获取子地区
	 */
	public function getAreas()
	{
		$pid = 0;
		if($this->input->get('pid')){
			$pid = $this->input->get('pid');
		}
		$this->load->model('OA_Areas');
		$areasInfo = $this->OA_Areas->queryAreasByPid($pid);	
		$this->send_json($areasInfo);
	}
}