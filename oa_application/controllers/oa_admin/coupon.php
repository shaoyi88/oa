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
		$data = $this->input->post();
		$data['coupon_condition'] = $data['coupon_condition'] ? $data['coupon_condition'] : 0;
		$data['has_used'] = 0;
		if(0 !== $data['coupon_condition'] && $data['coupon_amount'] > $data['coupon_condition']){
			redirect(formatUrl('user/detail?uid='.$data['user_id'].'&msg='.urlencode('优惠金额不可大于使用条件')));
			exit;
		}
		$data['coupon_expire'] = strtotime($data['coupon_expire']);
		$this->load->model('OA_Coupon');
		$this->OA_Coupon->add($data);
		redirect(formatUrl('user/detail?uid='.$data['user_id']));
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