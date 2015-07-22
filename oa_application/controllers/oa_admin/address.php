<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Address extends OA_Controller 
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}
	
	/**
	 * 
	 * 增加地址逻辑
	 */
	public function doAdd()
	{
		$data = array();
		if(checkRight('user_address_add') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$data = $this->input->post();
		$data['is_default'] = isset($data['is_default']) ? 1 : 0;
		$this->load->model('OA_Address');
		$this->OA_Address->add($data);
		redirect(formatUrl('user/detail?uid='.$data['user_id']));
	}
	
	/**
	 * 
	 * 删除
	 */
	public function doDel()
	{
		$data = array();
		if(checkRight('user_address_del') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$uid = $this->input->get('uid');
		$aid = $this->input->get('aid');
		$this->load->model('OA_Address');
		$this->OA_Address->del($aid);
		redirect(formatUrl('user/detail?uid='.$uid));
	}
	
	/**
	 * 
	 * 设置默认地址
	 */
	public function setAddressIsDefault()
	{
		$data = array();
		if(checkRight('user_address_add') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$uid = $this->input->get('uid');
		$aid = $this->input->get('aid');
		$this->load->model('OA_Address');
		$this->OA_Address->setAddressIsDefault($uid, $aid);
		redirect(formatUrl('user/detail?uid='.$uid));
	}
}