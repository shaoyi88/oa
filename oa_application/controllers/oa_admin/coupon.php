<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coupon extends OA_Controller 
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}
	
	/**
	 * 
	 * 增加红包逻辑
	 */
	public function doAdd()
	{
		$data = array();
		if(checkRight('coupon_add') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$user_id = $this->input->post('user_id');
		$coupon_amount = $this->input->post('coupon_amount');
		$coupon_condition = $this->input->post('coupon_condition') ? $this->input->post('coupon_condition') : 0;
		if(0 !== $coupon_condition && $coupon_amount > $coupon_condition){
			redirect(formatUrl('user/detail?uid='.$user_id.'&msg='.urlencode('优惠金额不可大于使用条件')));
			exit;
		}
		$coupon_expire = strtotime($this->input->post('coupon_expire'));
		$this->load->model('OA_Coupon');
		$this->OA_Coupon->add($user_id, $coupon_amount, $coupon_condition, $coupon_expire);
		redirect(formatUrl('user/detail?uid='.$user_id));
	}
	
	/**
	 * 
	 * 删除
	 */
	public function doDel()
	{
		$data = array();
		if(checkRight('coupon_del') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$uid = $this->input->get('uid');
		$cid = $this->input->get('cid');
		$this->load->model('OA_Coupon');
		$this->OA_Coupon->del($cid);
		redirect(formatUrl('user/detail?uid='.$uid));
	}
}