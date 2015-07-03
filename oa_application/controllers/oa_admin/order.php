<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends OA_Controller 
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}
	
	/**
	 * 
	 * 订单首页
	 */
	public function index()
	{
		$data = array();
		if(checkRight('order_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$this->load->model('OA_Order');
		if($this->input->post('keyword')){
			//$dataList = $this->OA_User->searchUser($this->input->post('keyword'));
		}else{
			$offset = 0;
			$pageUrl = '';
			page(formatUrl('order/index').'?', $this->OA_Order->getOrderCount(), PER_COUNT, $offset, $pageUrl);
			$dataList = $this->OA_Order->getOrder($offset, PER_COUNT);
			$data['pageUrl'] = $pageUrl;
		}
		$data['serviceTypeInfo'] = $this->config->item('customer_service_type');
		$data['order_service_mode'] = $this->config->item('order_service_mode');
		$data['order_fee_unit'] = $this->config->item('order_fee_unit');
		$data['order_status'] = $this->config->item('order_status');
		$data['dataList'] = $dataList;		
		$this->showView('orderList', $data);
	}
	
	/**
	 * 
	 * 创建订单
	 */
	public function add()
	{
		$data = array();
		if(checkRight('order_add') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$data['serviceTypeInfo'] = $this->config->item('customer_service_type');
		$data['order_service_mode'] = $this->config->item('order_service_mode');
		$data['order_fee_unit'] = $this->config->item('order_fee_unit');
		$this->showView('orderAdd', $data);
	}
	
	/**
	 * 
	 * 创建订单逻辑
	 */
	public function doAdd()
	{
		if(checkRight('order_add') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$data = $this->input->post();
		$msg = '';
		$this->load->model('OA_Order');
		$data['order_no'] = time().rand(100,999);
		$data['order_start_time'] = strtotime($data['order_start_time']);
		$data['order_status'] = 1;
		$data['admin_id'] = $this->userId;
		$data['add_time'] = $data['update_time'] = time();
		if($this->OA_Order->add($data) === FALSE){
			$msg = '?msg='.urlencode('创建失败');
		}
		redirect(formatUrl('order/index'.$msg));
	}
	
	/**
	 * 
	 * 取消订单
	 */
	public function doCancel()
	{
		if(checkRight('order_cancel') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$oid = $this->input->get('oid');
		$this->load->model('OA_Order');
		$orderInfo = $this->OA_Order->getOrderInfo($oid);
		if(empty($orderInfo)){
			redirect(formatUrl('order/index?msg='.urlencode('订单不存在')));
		}else if($orderInfo['order_status'] != 1){
			redirect(formatUrl('order/index?msg='.urlencode('该订单不可取消')));
		}else{
			$data['order_id'] = $oid;
			$data['order_status'] = 4;
			$this->OA_Order->update($data);
			redirect(formatUrl('order/index?msg='.urlencode('取消订单成功')));
		}
	}
	
	/**
	 * 
	 * 删除订单
	 */
	public function doDel()
	{
		if(checkRight('order_del') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$oid = $this->input->get('oid');
		$this->load->model('OA_Order');
		$orderInfo = $this->OA_Order->getOrderInfo($oid);
		if(empty($orderInfo)){
			redirect(formatUrl('order/index?msg='.urlencode('订单不存在')));
		}else if($orderInfo['order_status'] != 4){
			redirect(formatUrl('order/index?msg='.urlencode('该订单不可删除')));
		}else{
			$this->OA_Order->del($oid);
			redirect(formatUrl('order/index?msg='.urlencode('删除订单成功')));
		}
	}
}