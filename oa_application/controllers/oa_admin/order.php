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
			$dataList = $this->OA_Order->searchOrder($this->input->post('keyword'));
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
		if($this->input->get('oid')){
			if(checkRight('order_edit') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$uid = $this->input->get('uid');
			$data['typeMsg'] = '编辑';
			$oid = $this->input->get('oid');
			$this->load->model('OA_Order');
			$data['info'] = $this->OA_Order->getOrderInfo($oid);
			$data['order_start_time'] = date('Y-m-d H:i:s', $data['info']['order_start_time']);
			$this->load->model('OA_User');
			$data['userInfo'] = $this->OA_User->getUserInfo($data['info']['user_id']);
			$this->load->model('OA_Customer');
			$data['customerInfo'] = $this->OA_Customer->getCustomerInfo($data['info']['customer_id']);
		}else{
			if(checkRight('order_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data['typeMsg'] = '新增';
		}
		$data['order_service_mode'] = $this->config->item('order_service_mode');
		$data['order_fee_unit'] = $this->config->item('order_fee_unit');
		$this->showView('orderAdd', $data);
	}
	
	/**
	 * 
	 * 添加新用户订单
	 */
	public function addNew()
	{
		$data = array();
		if(checkRight('user_add') === FALSE || checkRight('customer_add') === FALSE ||
			checkRight('follow_add') === FALSE || checkRight('order_add') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		//用户信息相关
		$this->load->model('OA_Areas');
		$provinceInfo = $cityInfo = array();
		$provinceInfo = $this->OA_Areas->queryAreasByPid(0);	
		$data['provinceInfo'] = $provinceInfo;
		$data['cityInfo'] = $cityInfo;
		$data['sexInfo'] = $this->config->item('sex');
		//客户信息相关
		$data['languageInfo'] = $this->config->item('customer_language');
		$data['serviceTypeInfo'] = $this->config->item('customer_service_type');
		$data['groupInfo'] = $this->config->item('customer_group');
		$this->load->model('OA_Hospital');	
		$data['hospitalInfo'] = $this->OA_Hospital->queryByPid(0);	
		//订单信息相关
		$data['order_service_mode'] = $this->config->item('order_service_mode');
		$data['order_fee_unit'] = $this->config->item('order_fee_unit');
		$this->showView('orderAddNew', $data);
	}

	/**
	 *
	 * 创建订单逻辑
	 */
	public function doAdd()
	{
		$data = array();
		if($this->input->post('order_id')){
			if(checkRight('order_edit') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$serviceTypeInfo = $this->config->item('customer_service_type');
			$order_service_mode = $this->config->item('order_service_mode');
			$order_fee_unit = $this->config->item('order_fee_unit');
			$data = $this->input->post();
			$data['order_start_time'] = strtotime($data['order_start_time']);
			$this->load->model('OA_Order');
			$this->load->model('OA_OrderHistory');
			$orderInfo = $this->OA_Order->getOrderInfo($data['order_id']);
			$orderHistory = array('order_id'=>$data['order_id'],'admin_id'=>$this->userId,'admin_name'=>$this->userName,'add_time'=>time(),'order_pre_info'=>'','order_cur_info'=>'');
			$update = FALSE;
			$order_pre_info = $order_cur_info = array();
			if(isset($data['service_type']) && $data['service_type'] != $orderInfo['service_type']){
				$order_pre_info[] = '服务类型：'.$serviceTypeInfo[$orderInfo['service_type']];
				$order_cur_info[] = '服务类型：'.$serviceTypeInfo[$data['service_type']];
				$update = TRUE;
			}
			if(isset($data['service_mode']) && $data['service_mode'] != $orderInfo['service_mode']){
				$order_pre_info[] = '服务模式：'.$order_service_mode[$orderInfo['service_type']][0];
				$order_cur_info[] = '服务模式：'.$order_service_mode[$data['service_type']][0];
				$update = TRUE;
			}
			if($data['order_fee'] != $orderInfo['order_fee'] || $data['order_fee_unit'] != $orderInfo['order_fee_unit']){
				$order_pre_info[] = '收费标准：'.$orderInfo['order_fee'].'/'.$order_fee_unit[$orderInfo['order_fee_unit']];
				$order_cur_info[] = '收费标准：'.$data['order_fee'].'/'.$order_fee_unit[$data['order_fee_unit']];
				$update = TRUE;
			}
			if(isset($data['order_start_time']) && $data['order_start_time'] != $orderInfo['order_start_time']){
				$order_pre_info[] = '开始时间：'.date('Y-m-d H:i:s',$orderInfo['order_start_time']);
				$order_cur_info[] = '开始时间：'.date('Y-m-d H:i:s',$data['order_start_time']);
				$update = TRUE;
			}
			if($update){
				$orderHistory['order_pre_info'] = json_encode($order_pre_info);
				$orderHistory['order_cur_info'] = json_encode($order_cur_info);
				$this->OA_Order->update($data);
				$this->OA_OrderHistory->add($orderHistory);
			}
			redirect(formatUrl('order/index'));
		}else{
			if(checkRight('order_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data = $this->input->post();
			$msg = '';
			$this->load->model('OA_Order');
			$info = $this->OA_Order->getOrderInfoByCustomerId($data['customer_id']);
			if(empty($info)){
				$data['order_no'] = time().rand(100,999);
				$data['order_start_time'] = strtotime($data['order_start_time']);
				$data['order_status'] = 1;
				$data['admin_id'] = $this->userId;
				$data['admin_name'] = $this->userName;
				$data['add_time'] = time();
				if($this->OA_Order->add($data) === FALSE){
					$msg = '?msg='.urlencode('创建失败');
				}
				$this->_orderNotify($data);
			}else{
				$msg = '?msg='.urlencode('该客户已存在订单，请勿重复新增');
			}
			redirect(formatUrl('order/index'.$msg));
		}
	}
	
	/**
	 *
	 * 创建新用户订单逻辑
	 */
	public function doAddNew()
	{
		$data = array();
		if(checkRight('user_add') === FALSE || checkRight('customer_add') === FALSE ||
			checkRight('follow_add') === FALSE || checkRight('order_add') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$data = $this->input->post();
		//新增用户
		$this->load->model('OA_User');
		$addUserInfo['user_name'] = $data['user_name'];
		$addUserInfo['user_phone'] = $data['user_phone'];
		$addUserInfo['user_sex'] = $data['user_sex'];
		$addUserInfo['user_province'] = $data['user_province'];
		$addUserInfo['user_city'] = $data['user_city'];
		$uid = $this->OA_User->add($addUserInfo);
		//新建客户
		$this->load->model('OA_Customer');
		$addCustomerInfo['customer_name'] = $data['customer_name'];
		$addCustomerInfo['customer_sex'] = $data['customer_sex'];
		$addCustomerInfo['customer_age'] = $data['customer_age'];
		$addCustomerInfo['customer_card'] = $data['customer_card'];
		$addCustomerInfo['customer_language'] = $data['customer_language'] == '其他' ? $data['other_language'] : $data['customer_language'];
		$addCustomerInfo['customer_type'] = $data['customer_type'];
		$addCustomerInfo['customer_address'] = $data['customer_address'];
		$addCustomerInfo['customer_hospital'] = $data['customer_hospital'];
		$addCustomerInfo['customer_hospital_department'] = $data['customer_hospital_department'];
		$addCustomerInfo['customer_bed_no'] = $data['customer_bed_no'];
		$addCustomerInfo['customer_service_type'] = $data['customer_service_type'];
		$cid = $this->OA_Customer->add($addCustomerInfo);
		//新建用户客户关联
		$this->load->model('OA_Follow');
		$addFollowInfo['user_id'] = $uid;
		$addFollowInfo['customer_id'] = $cid;
		$addFollowInfo['relationship'] = $data['relationship'];
		$this->OA_Follow->add($addFollowInfo);
		//新建订单
		$this->load->model('OA_Order');
		$addOrderInfo['order_no'] = time().rand(100,999);
		$addOrderInfo['user_id'] = $uid;
		$addOrderInfo['customer_id'] = $cid;
		$addOrderInfo['service_type'] = $data['customer_service_type'];
		$addOrderInfo['service_mode'] = $data['service_mode'];
		$addOrderInfo['order_fee'] = $data['order_fee'];
		$addOrderInfo['order_fee_unit'] = $data['order_fee_unit'];
		$addOrderInfo['order_start_time'] = strtotime($data['order_start_time']);
		$addOrderInfo['order_status'] = 1;
		$addOrderInfo['admin_id'] = $this->userId;
		$addOrderInfo['admin_name'] = $this->userName;
		$addOrderInfo['add_time'] = time();
		$this->OA_Order->add($addOrderInfo);
		$this->_orderNotify($addOrderInfo);
		redirect(formatUrl('order/index'));
	}

	/**
	 *
	 * 取消订单
	 */
	public function doCancel()
	{
		$data = array();
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
			$data['order_status'] = 5;
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
		$data = array();
		if(checkRight('order_del') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$oid = $this->input->get('oid');
		$this->load->model('OA_Order');
		$orderInfo = $this->OA_Order->getOrderInfo($oid);
		if(empty($orderInfo)){
			redirect(formatUrl('order/index?msg='.urlencode('订单不存在')));
		}else if($orderInfo['order_status'] != 5){
			redirect(formatUrl('order/index?msg='.urlencode('该订单不可删除')));
		}else{
			$this->OA_Order->del($oid);
			redirect(formatUrl('order/index?msg='.urlencode('删除订单成功')));
		}
	}

	/**
	 *
	 * 详情页面
	 */
	public function detail()
	{
		$data = array();
		if(checkRight('order_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$oid = $this->input->get('oid');
		$hideTitle = FALSE;
		if($this->input->get('hideTitle')){
			$hideTitle = TRUE;;
		}
		$data['hideTitle'] = $hideTitle;
		$this->load->model('OA_Order');
		$data['orderInfo'] = $this->OA_Order->getOrderInfo($oid);
		$this->load->model('OA_User');
		$data['userInfo'] = $this->OA_User->getUserInfo($data['orderInfo']['user_id']);
		$this->load->model('OA_Customer');
		$data['customerInfo'] = $this->OA_Customer->getCustomerInfo($data['orderInfo']['customer_id']);
		$this->load->model('OA_OrderHistory');
		$data['historyInfo'] = $this->OA_OrderHistory->queryHistoryByOrderId($oid);
		$data['serviceTypeInfo'] = $this->config->item('customer_service_type');
		$data['order_service_mode'] = $this->config->item('order_service_mode');
		$data['order_fee_unit'] = $this->config->item('order_fee_unit');
		$data['order_status'] = $this->config->item('order_status');
		$this->load->model('OA_WorkerOrder');
		$this->load->model('OA_Hospital');
		$data['workerList'] = $this->OA_WorkerOrder->getOrderWorkers($oid, TRUE);
		$data['sexInfo'] = $this->config->item('sex');
		$data['nInfo'] = $this->OA_Hospital->getNameList();
		$this->showView('orderDetail', $data);
	}

	/**
	 *
	 * 指派护工
	 */
	public function setWorker()
	{
		$data = array();
		if(checkRight('order_set_worker') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$oid = $this->input->get('oid');
		$this->load->model('OA_Order');
		$orderInfo = $this->OA_Order->getOrderInfo($oid);
		if(empty($orderInfo)){
			redirect(formatUrl('order/index?msg='.urlencode('订单不存在')));
		}else if($orderInfo['order_status'] != 1 && $orderInfo['order_status'] != 6){
			redirect(formatUrl('order/index?msg='.urlencode('该订单不可指派护工')));
		}
		$order_service_mode = $this->config->item('order_service_mode');
		$this->load->model('OA_Worker');
		$data['workerList'] = $this->OA_Worker->queryWorkerByInfo($orderInfo['service_type'], $order_service_mode[$orderInfo['service_mode']][1], $order_service_mode[$orderInfo['service_mode']][2]);
		$data['isMult'] = $order_service_mode[$orderInfo['service_mode']][3];
		$data['orderInfo'] = $orderInfo;
		$this->showView('orderSetWorker', $data);
	}

	/**
	 *
	 * 指派护工逻辑
	 */
	public function doSetWorker()
	{
		$data = array();
		if(checkRight('order_set_worker') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$data = $this->input->post();
		// 更新订单状态
		$this->load->model('OA_Order');
		$this->OA_Order->update(array('order_id'=>$data['order_id'], 'order_status'=>2));
		// 增加护工订单记录
		$this->load->model('OA_WorkerOrder');
		$workerOrder = $workerList = array();
		foreach($data['worker_id'] as $item){
			$order = $data;
			$order['worker_id'] = $item;
			$order['status'] = 1;
			$workerList[] = $item;
			$workerOrder[] = $order;
		}
		$this->OA_WorkerOrder->addBatch($workerOrder);
		// 更新护工状态
		$this->load->model('OA_Worker');
		$this->OA_Worker->updateBatch($workerList, array('worker_status'=>1));
		redirect(formatUrl('order/index'));
	}

	/**
	 *
	 * 更换护工
	 */
	public function changeWorker()
	{
		$data = array();
		if(checkRight('order_change_worker') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$oid = $this->input->get('oid');
		$this->load->model('OA_Order');
		$orderInfo = $this->OA_Order->getOrderInfo($oid);
		if(empty($orderInfo)){
			redirect(formatUrl('order/index?msg='.urlencode('订单不存在')));
		}else if($orderInfo['order_status'] != 2){
			redirect(formatUrl('order/index?msg='.urlencode('该订单不可更换护工')));
		}
		$this->load->model('OA_WorkerOrder');
		$data['curWorkerList'] = $this->OA_WorkerOrder->getOrderWorkers($oid);
		foreach($data['curWorkerList'] as $worker){
			$curWorkerIds[] = $worker['worker_id'];
		}
		$order_service_mode = $this->config->item('order_service_mode');
		$this->load->model('OA_Worker');
		$workerList = $this->OA_Worker->queryWorkerByInfo($orderInfo['service_type'], $order_service_mode[$orderInfo['service_mode']][1], $order_service_mode[$orderInfo['service_mode']][2]);
		foreach($workerList as $worker){
			if(!in_array($worker['worker_id'], $curWorkerIds)){
				$data['workerList'][] = $worker;
			}
		}
		$data['isMult'] = $order_service_mode[$orderInfo['service_mode']][3];
		$data['orderInfo'] = $orderInfo;
		$this->showView('orderChangeWorker', $data);
	}

	/**
	 *
	 * 更换护工逻辑
	 */
	public function doChangeWorker()
	{
		$data = array();
		if(checkRight('order_change_worker') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$data = $this->input->post();
		$this->load->model('OA_Order');
		$orderInfo = $this->OA_Order->getOrderInfo($data['order_id']);
		$curTime = time();
		// 增加替换的护工订单记录
		$this->load->model('OA_WorkerOrder');
		$this->load->model('OA_Worker');
		$workerOrder = $workerList = array();
		foreach($data['worker_id'] as $item){
			$order = array();
			$order['order_id'] = $data['order_id'];
			$order['worker_id'] = $item;
			$order['start_time'] = $curTime;
			$order['status'] = 1;
			$workerList[] = $item;
			$workerOrder[] = $order;
		}
		$this->OA_WorkerOrder->addBatch($workerOrder);
		// 更新替换的护工状态
		$this->OA_Worker->updateBatch($workerList, array('worker_status'=>1));
		// 结算被替换的护工工资
		$info = $this->OA_WorkerOrder->getOrderByWorkerId($data['cur_worker_id']);
		$hasOrderWorker = array();
		foreach($info as $item)
		{
			if($item['order_id'] == $data['order_id']){  //结算当前订单
				$workerTime = $curTime - $item['start_time'];
				$order = array();
				$order['id'] = $item['id'];
				$order['end_time'] = $curTime;
				$order['status'] = 0;
				$order['salary'] = calculateOrderCost($orderInfo, $workerTime);
				$this->OA_WorkerOrder->update($order);
			}else{
				$hasOrderWorker[] = $item['worker_id'];  //目前仍有订单的护工不需要更新状态
			}
		}
		// 更新被替换的护工状态
		$updateWorker = array_diff($data['cur_worker_id'], $hasOrderWorker);
		$this->OA_Worker->updateBatch($updateWorker, array('worker_status'=>2));
		redirect(formatUrl('order/index'));
	}

	/**
	 *
	 * 收款页面
	 */
	public function collection()
	{
		$data = array();
		if(checkRight('order_collection') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$oid = $this->input->get('oid');
		$this->load->model('OA_Order');
		$orderInfo = $this->OA_Order->getOrderInfo($oid);
		if(empty($orderInfo)){
			redirect(formatUrl('order/index?msg='.urlencode('订单不存在')));
		}else if($orderInfo['order_status'] != 2 && $orderInfo['order_status'] != 6){
			redirect(formatUrl('order/index?msg='.urlencode('该订单不可收款')));
		}
		$data['orderInfo'] = $orderInfo;
		$data['order_collection_type'] = $this->config->item('order_collection_type');
		$data['order_fee_unit'] = $this->config->item('order_fee_unit');
		$data['order_advance_payment'] = $orderInfo['order_advance_payment'] ? $orderInfo['order_advance_payment'] : 0;
		$this->load->model('OA_WorkerOrder');
		$data['workerInfo'] = $this->OA_WorkerOrder->getOrderWorkers($orderInfo['order_id'], TRUE);
		$this->load->model('OA_User');
		$data['userInfo'] = $this->OA_User->getUserInfo($orderInfo['user_id']);
		$this->load->model('OA_Customer');
		$data['customerInfo'] = $this->OA_Customer->getCustomerInfo($orderInfo['customer_id']);
		// 计费单位
		switch($orderInfo['order_fee_unit']){
			case 1:
				$timeUnit = 60*60*24*30;
				break;
			case 2:
				$timeUnit = 60*60*24;
				break;
			case 3:
				$timeUnit = 60*60;
				break;
		}
		$data['timeUnit'] = $timeUnit;
		$data['order_fee'] = $orderInfo['order_fee'];
		$this->showView('orderCollection', $data);
	}

	/**
	 *
	 * 收款逻辑
	 */
	public function doCollection()
	{
		$data = array();
		if(checkRight('order_collection') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$data = $this->input->post();
		if($data['collection_type'] == 1){//预付逻辑
			$this->load->model('OA_OrderCollection');
			$info['order_id'] = $data['order_id'];
			$info['order_no'] = $data['order_no'];
			$info['collection_type'] = $data['collection_type'];
			$info['collection_amount'] = $data['collection_amount_1'];
			$data['collection_amount'] = $info['collection_amount'];
			$info['collection_status'] = 1;
			$info['bill_status'] = 1;
			$info['add_time'] = time();
			$data['add_time'] = $info['add_time'];
			$this->OA_OrderCollection->add($info);
		}else if($data['collection_type'] == 2){//结算逻辑
			$this->load->model('OA_WorkerOrder');
			$this->load->model('OA_Worker');
			$this->load->model('OA_OrderCollection');
			$this->load->model('OA_Order');
			$orderInfo = $this->OA_Order->getOrderInfo($data['order_id']);
			$endTime = strtotime($data['order_end_time']);
			//结算护工工资
			$workerInfo = $this->OA_WorkerOrder->getOrderByWorkerId($data['worker']);
			$hasOrderWorker = array();
			foreach($workerInfo as $item)
			{
				if($item['order_id'] == $data['order_id']){  //结算当前订单
					$workerTime = $endTime - $item['start_time'];
					$order = array();
					$order['id'] = $item['id'];
					$order['end_time'] = $endTime;
					$order['status'] = 0;
					$order['salary'] = calculateOrderCost($orderInfo, $workerTime);
					$this->OA_WorkerOrder->update($order);
				}else{
					$hasOrderWorker[] = $item['worker_id'];  //目前仍有订单的护工不需要更新状态
				}
			}
			//更改护工状态
			$updateWorker = array_diff($data['worker'], $hasOrderWorker);
			$this->OA_Worker->updateBatch($updateWorker, array('worker_status'=>2));
			//增加收款记录
			$info['order_id'] = $data['order_id'];
			$info['order_no'] = $data['order_no'];
			$info['collection_type'] = $data['collection_type'];
			$info['collection_amount'] = $data['collection_amount_2'];
			$data['collection_amount'] = $info['collection_amount'];
			$info['collection_status'] = 1;
			$info['bill_status'] = 1;
			$info['add_time'] = time();
			$data['add_time'] = $info['add_time'];
			$this->OA_OrderCollection->add($info);
			//修改订单状态
			$updateOrder['order_id'] = $data['order_id'];
			$updateOrder['order_end_time'] = $endTime;
			$updateOrder['order_status'] = 3;
			$updateOrder['order_total_cost'] = $orderInfo['order_advance_payment'] + $data['collection_amount_2'];
			$this->OA_Order->update($updateOrder);
		}
		$this->_collectionNotify($data);
		redirect(formatUrl('order/index'));
	}
	
	/**
	 * 
	 * 订单创建的短信与微信通知
	 * @param unknown_type $data
	 */
	private function _orderNotify($data)
	{
		$this->load->model('OA_User');
		$userInfo = $this->OA_User->getUserInfo($data['user_id']);
		$customer_service_type = $this->config->item('customer_service_type');
		$order_service_mode = $this->config->item('order_service_mode');
		$order_fee_unit = $this->config->item('order_fee_unit');
		//发送微信通知
		if($userInfo['wechat_openid']){			
        	$templateid = '_6dzSfbD6Jk1UQdk424zE88mR1n8sK2vbAtNoBQxayQ';
        	$content = array(
            	"first"    => array("value" => "根据评估结果，您的订单已创建\n订单号：".$data['order_no'], "color" => '#000000'),
            	"keyword1" => array("value" => $customer_service_type[$data['service_type']]."\n服务方式：".$order_service_mode[$data['service_mode']][0]."\n收费标准：".$data['order_fee']."元/".$order_fee_unit[$data['order_fee_unit']], "color" => '#000000'),
            	"keyword2" => array("value" => date('Y-m-d H:i:s', $data['order_start_time'])."开始服务", "color" => '#000000'),
            	"remark"   => array("value" => "请您尽快确认订单信息", "color" => '#000000')
        	);
        	$this->load->helper('weixin');
        	templateSend($userInfo['wechat_openid'], $templateid, '', $content);
		}
		//发送短信通知
		if($userInfo['user_phone']){
			$apikey = 'cf34160f4719430181a3d387f9dda3c8';
			$templateid = '936939';
			$content = '#name#='.$userInfo['user_name'].',根据评估结果&#type#='.$customer_service_type[$data['service_type']].'&#detail#=创建,订单号:'.$data['order_no'].',请您登录微信尽快确认订单信息！';
			$this->load->helper('sms');
			tpl_send_sms($apikey, $templateid, $content, $userInfo['user_phone']);
		}
	}
	
	/**
	 * 
	 * 收款的短信与微信通知
	 * @param unknown_type $data
	 */
	private function _collectionNotify($data)
	{
		$this->load->model('OA_User');
		$userInfo = $this->OA_User->getUserInfo($data['user_id']);
		$order_collection_type = $this->config->item('order_collection_type');
		//发送微信通知
		if($userInfo['wechat_openid']){		
			$templateid = '4wsEh-wT0nOhimM-_RBtanVFO57O0ufK-laqzv5oNhM';
        	$content = array(
            	"first"    => array("value" => "您好，您有一笔费用需要支付", "color" => '#000000'),
            	"keyword1" => array("value" => $data['order_no'], "color" => '#000000'),
            	"keyword2" => array("value" => $data['collection_amount']."元\n收款分类：".$order_collection_type[$data['collection_type']]."\n客户姓名：".$data['customer_name'], "color" => '#000000'),
            	"keyword3"   => array("value" => date('Y-m-d H:i:s', $data['add_time']), "color" => '#000000')
        	);
        	$this->load->helper('weixin');
        	templateSend($userInfo['wechat_openid'], $templateid, '', $content);
		}
		//发送短信通知
		if($userInfo['user_phone']){
			$apikey = 'cf34160f4719430181a3d387f9dda3c8';
			$templateid = '937417';
			$content = '#name#='.$userInfo['user_name'].'&#type#='.$order_collection_type[$data['collection_type']].'&#number#='.$data['order_no'].'&#money#='.$data['collection_amount'];
			$this->load->helper('sms');
			print_r(tpl_send_sms($apikey, $templateid, $content, $userInfo['user_phone']));exit;
		}
	}
}