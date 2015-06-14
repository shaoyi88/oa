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
		if(checkRight('address_add') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$user_id = $this->input->post('user_id');
		$province = $this->input->post('province');
		$city = $this->input->post('city');
		$area = $this->input->post('area');
		$address = $this->input->post('address');
		$is_default = $this->input->post('is_default') ? 1 : 0;
		$this->load->model('OA_Address');
		$this->OA_Address->add($user_id, $province, $city, $area, $address, $is_default);
		redirect(formatUrl('user/detail?uid='.$user_id));
	}
	
	/**
	 * 
	 * 删除
	 */
	public function doDel()
	{
		$data = array();
		if(checkRight('address_del') === FALSE){
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
		if(checkRight('address_add') === FALSE){
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