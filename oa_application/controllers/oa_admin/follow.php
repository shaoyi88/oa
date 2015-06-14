<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Follow extends OA_Controller 
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}
	
	/**
	 * 
	 * 增加关注病人逻辑
	 */
	public function doAdd()
	{
		$data = array();
		if(checkRight('follow_add') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$user_id = $this->input->post('user_id');
		$customer_id = $this->input->post('customer_id');
		$this->load->model('OA_Customer');
		$customerInfo = $this->OA_Customer->queryCustomerByid($customer_id);
		if(empty($customerInfo)){
			redirect(formatUrl('user/detail?uid='.$user_id.'&msg='.urlencode('没有此病人信息，请确认ID无误')));
			exit;
		}
		$this->load->model('OA_Follow');
		$this->OA_Follow->add($user_id, $customer_id);
		redirect(formatUrl('user/detail?uid='.$user_id));
	}
	
	/**
	 * 
	 * 删除
	 */
	public function doDel()
	{
		$data = array();
		if(checkRight('follow_del') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$uid = $this->input->get('uid');
		$fid = $this->input->get('fid');
		$this->load->model('OA_Follow');
		$this->OA_Follow->del($fid);
		redirect(formatUrl('user/detail?uid='.$uid));
	}
}