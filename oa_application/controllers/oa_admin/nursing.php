<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nursing extends OA_Controller 
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}
	
	/**
	 * 
	 * 护理计划
	 */
	public function planList()
	{
		$data = array();
		if(checkRight('nursing_plan_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$this->load->model('OA_NursingPlan');
		if($this->input->post('keyword')){
			$dataList = $this->OA_NursingPlan->searchPlan($this->input->post('keyword'));
		}else{
			$offset = 0;
			$pageUrl = '';
			page(formatUrl('nursing/planList').'?', $this->OA_NursingPlan->getNursingPlanCount(), PER_COUNT, $offset, $pageUrl);
			$dataList = $this->OA_NursingPlan->getNursingPlan($offset, PER_COUNT);
			$data['pageUrl'] = $pageUrl;
		}
		$data['dataList'] = $dataList;		
		$this->showView('nursingPlanList', $data);
	}
	
	/**
	 * 
	 * 添加护理计划
	 */
	public function planAdd()
	{
		$data = array();
		if($this->input->get('pid')){
			if(checkRight('nursing_plan_edit') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$pid = $this->input->get('pid');
			$this->load->model('OA_NursingPlan');
			$info = $this->OA_NursingPlan->getInfo($pid);
			$data['info'] = $info;
			$data['typeMsg'] = '编辑';
		}else{
			if(checkRight('nursing_plan_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data['typeMsg'] = '新增';
		}
		$this->showView('planAdd', $data);
	}
	
	/**
	 * 
	 * 护理计划增加/编辑逻辑
	 */
	public function planDoAdd()
	{
		$data = array();
		if($this->input->post('plan_id')){
			if(checkRight('nursing_plan_edit') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data = $this->input->post();
			$this->load->model('OA_NursingPlan');
			$this->OA_NursingPlan->update($data);
			redirect(formatUrl('nursing/planList'));
		}else{
			if(checkRight('nursing_plan_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data = $this->input->post();
			$this->load->model('OA_NursingPlan');
			$info = $this->OA_NursingPlan->getInfoByOrderId($data['order_id']); 
			if(empty($info)){
				$data['add_time'] = time();
				$data['admin_id'] = $this->userId;
				$data['admin_name'] = $this->userName;
				$msg = '';
				if($this->OA_NursingPlan->add($data) === FALSE){
					$msg = '?msg='.urlencode('创建失败');
				}
			}else{
				$msg = '?msg='.urlencode('已存在该订单的护理计划，请勿重复新增');
			}
			redirect(formatUrl('nursing/planList'.$msg));
		}
	}
	
	/**
	 * 
	 * 获取信息
	 */
	public function getInfo()
	{
		if($this->input->get('customerName')){
			$customerName = $this->input->get('customerName');
		}
		$this->load->model('OA_Order');
		$orderInfo = $this->OA_Order->searchOrderByCustomerName($customerName);	
		if(empty($orderInfo)){			
			$this->send_json(array('status'=>0));
			exit;
		}else{
			$this->load->model('OA_Worker');
			$workerInfo = $this->OA_Worker->searchWorkerByOrderId($orderInfo['order_id']);
			if(empty($workerInfo)){			
				$this->send_json(array('status'=>0));
				exit;
			}else{
				$info = array_merge($orderInfo, $workerInfo);
				$this->send_json(array('status'=>1,'infoList'=>$info));
			}
		}
	}
	
	/**
	 * 
	 * 删除逻辑
	 */
	public function planDoDel()
	{
		if(checkRight('nursing_plan_del') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$pid = $this->input->get('pid');
		$this->load->model('OA_NursingPlan');
		$this->OA_NursingPlan->del($pid);
		//删除回访计划
		$this->load->model('OA_NursingReturn');
		$this->OA_NursingReturn->delByPlanId($pid);
		redirect(formatUrl('nursing/planList'));
	}
	
	/**
	 * 
	 * 护理计划详情页面
	 */
	public function planDetail()
	{
		$data = array();
		if(checkRight('nursing_plan_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$pid = $this->input->get('pid');
		$hideTitle = FALSE;
		if($this->input->get('hideTitle')){
			$hideTitle = TRUE;;
		}
		$data['hideTitle'] = $hideTitle;
		$this->load->model('OA_NursingPlan');
		$data['planInfo'] = $this->OA_NursingPlan->getInfo($pid);
		$this->showView('planDetail', $data);
	}
	
	/**
	 * 
	 * 增加回访计划
	 */
	public function returnAdd()
	{
		$data = array();
		if(checkRight('nursing_return_add') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$pid = $this->input->get('pid');
		$cid = $this->input->get('cid');
		$data['plan_id'] = $pid;
		$data['customer_id'] = $cid;
		$this->load->model('OA_Customer');
		$customerInfo = $this->OA_Customer->getCustomerInfo($cid);
		$data['customer_name'] = $customerInfo['customer_name'];
		if($customerInfo['customer_type'] == 1){
			$data['customer_address'] = $customerInfo['customer_address'];
		}else{
			$this->load->model('OA_Hospital');	
			$hospitalNameInfo = $this->OA_Hospital->getNameList();
			$data['customer_address'] = $hospitalNameInfo[$customerInfo['customer_hospital']].'-'.$hospitalNameInfo[$customerInfo['customer_hospital_department']].'-'.$customerInfo['customer_bed_no'];
		}
		$this->load->model('OA_Admin');
		$data['adminList'] = $this->OA_Admin->queryReturnAdmin();
		$this->showView('returnAdd', $data);
	}
	
	/**
	 * 
	 * 增加回访计划逻辑
	 */
	public function returnDoAdd()
	{
		$data = array();
		if(checkRight('nursing_return_add') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$data = $this->input->post();
		$data['return_time'] = strtotime($data['return_time']);
		$data['return_status'] = 0;
		$data['admin_id'] = $this->userId;
		$data['admin_name'] = $this->userName;
		$this->load->model('OA_NursingReturn');
		if($this->OA_NursingReturn->add($data) === FALSE){
			$msg = '?msg='.urlencode('创建失败');
		}
		redirect(formatUrl('nursing/planList'.$msg));
	}
	
	/**
	 * 
	 * 回访计划
	 */
	public function returnList()
	{
		$data = array();
		if(checkRight('nursing_return_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$this->load->model('OA_NursingReturn');
		$executive_admin_id = '';
		if($this->input->get_post('executive_admin_id')){
			$executive_admin_id = $this->input->get_post('executive_admin_id');
		}
		$data['executive_admin_id'] = $executive_admin_id;
		if($this->input->post('keyword')){
			$dataList = $this->OA_NursingReturn->searchNursingReturn($this->input->post('keyword'),$executive_admin_id);
		}else{
			$offset = 0;
			$pageUrl = '';
			page(formatUrl('nursing/returnList').'?', $this->OA_NursingReturn->getNursingReturnCount($executive_admin_id), PER_COUNT, $offset, $pageUrl);
			$dataList = $this->OA_NursingReturn->getNursingReturn($executive_admin_id, $offset, PER_COUNT);
			$data['pageUrl'] = $pageUrl;
		}
		$data['dataList'] = $dataList;	
		$data['admin_id'] = $this->userId;
		$this->showView('nursingReturnList', $data);
	}
	
	/**
	 * 
	 * 删除逻辑
	 */
	public function returnDoDel()
	{
		if(checkRight('nursing_return_del') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$rid = $this->input->get('rid');
		$this->load->model('OA_NursingReturn');
		$this->OA_NursingReturn->del($rid);
		redirect(formatUrl('nursing/returnList'));
	}
	
	/**
	 * 
	 * 回访登记
	 */
	public function returnRegister()
	{
		$data = array();
		if(checkRight('nursing_return_register') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$rid = $this->input->get('rid');
		$this->load->model('OA_NursingReturn');
		$data['info'] = $this->OA_NursingReturn->getInfo($rid);
		$this->showView('returnRegister', $data);
	}
	
	/**
	 * 
	 * 回访登记逻辑
	 */
	public function returnDoRegister()
	{
		$data = array();
		if(checkRight('nursing_return_register') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$data = $this->input->post();
		$this->load->model('OA_NursingReturn');
		if($data['return_time']){
			$addData = $data;
			$addData['return_time'] = strtotime($addData['return_time']);
			$addData['return_status'] = 0;
			unset($addData['return_id']);
			unset($addData['return_record']);
			unset($addData['push_content']);
			$this->load->model('OA_NursingReturn');
			$this->OA_NursingReturn->add($addData);
		}
		$updateData = array();
		$updateData['return_id'] = $data['return_id'];
		$updateData['return_record'] = $data['return_record'];
		$updateData['push_content'] = $data['push_content'];
		$updateData['return_status'] = 1;
		$this->OA_NursingReturn->update($updateData);
		redirect(formatUrl('nursing/returnList'));
	}
}