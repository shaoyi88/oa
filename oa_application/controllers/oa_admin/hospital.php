<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hospital extends OA_Controller 
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}
	
	/**
	 * 
	 * 获取子部门
	 */
	public function getDepartment()
	{
		$pid = 0;
		if($this->input->get('pid')){
			$pid = $this->input->get('pid');
		}
		$this->load->model('OA_Hospital');
		$departmentInfo = $this->OA_Hospital->queryByPid($pid);	
		$this->send_json($departmentInfo);
	}
}