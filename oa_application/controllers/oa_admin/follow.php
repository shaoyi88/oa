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
		$data = $this->input->post();
		$this->load->model('OA_Follow');
		$this->OA_Follow->add($data);
		if($this->input->get('type') == 1){
			redirect(formatUrl('user/detail?uid='.$data['user_id']));
		}else{
			redirect(formatUrl('customer/detail?cid='.$data['customer_id']));
		}
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
		$uid = $this->input->get('uid') ? $this->input->get('uid') : NULL;
		$cid = $this->input->get('cid') ? $this->input->get('cid') : NULL;
		$fid = $this->input->get('fid');
		$this->load->model('OA_Follow');
		$this->OA_Follow->del($fid);
		if(!is_null($uid)){
			redirect(formatUrl('user/detail?uid='.$uid));
		}else if(!is_null($cid)){
			redirect(formatUrl('customer/detail?cid='.$cid));
		}
	}
}