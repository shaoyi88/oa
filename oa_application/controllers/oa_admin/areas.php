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

	/*
	 * 区城镇模糊搜索获取城市
	 */
	public function getCity()
	{
		if($this->input->get('pid')&&$this->input->get('k')){
			$k = $this->input->get('k');
			$pid = $this->input->get('pid');
			$this->load->model('OA_Areas');
		    $cityInfo = $this->OA_Areas->queryCityByKey($pid,$k);
		    $this->send_json($cityInfo);
		}else{
			return;
		}
	}
}