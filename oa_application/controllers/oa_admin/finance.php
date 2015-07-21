<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Finance extends OA_Controller
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}

	/**
	 *
	 * 收款管理
	 */
	public function collect()
	{
		$data = array();
		if(checkRight('worker_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$this->load->model('OA_Finance');
		if($this->input->post('keyword')){
			$dataList = $this->OA_Finance->searchCollect($this->input->post('keyword'));
		}else{
			$offset = 0;
			$pageUrl = '';
			page(formatUrl('finance/collect').'?', $this->OA_Finance->getCollectCount(), PER_COUNT, $offset, $pageUrl);
			$dataList = $this->OA_Finance->getCollect($offset, PER_COUNT);
			$data['pageUrl'] = $pageUrl;
		}
		$data['dataList'] = $dataList;
		$data['order_collection_type'] = $this->config->item('order_collection_type');
		$data['order_collection_status'] = $this->config->item('order_collection_status');
		$data['order_payment_type'] = $this->config->item('order_payment_type');
		$data['order_bill_status'] = $this->config->item('order_bill_status');
		$this->load->model('OA_Hospital');
		$data['nInfo'] = $this->OA_Hospital->getNameList();
		$data['title'] = $this->config->item('service_level_1');
		$this->showView('financeCollect', $data);
	}

	/**
	 *
	 * 收款详情
	 */
	public function collectdetail()
	{
		$data = array();
		if(checkRight('finance_collect') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$cid = $this->input->get('cid');
		$data['collection_id'] = $cid;
		$this->load->model('OA_Finance');
		$data['collectInfo'] = $this->OA_Finance->getCollectInfo($cid);
		$data['order_collection_type'] = $this->config->item('order_collection_type');
		$data['order_collection_status'] = $this->config->item('order_collection_status');
		$data['order_payment_type'] = $this->config->item('order_payment_type');
		$data['order_bill_status'] = $this->config->item('order_bill_status');
		$this->showView('financeCollectDetail', $data);
	}

	/**
	 * 收款
	 */
    public function collection()
	{
		$data = array();
		if(checkRight('finance_collect') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$cid = $this->input->get('cid');
		$data['collection_id'] = $cid;
		$this->load->model('OA_Finance');
		$data['collectInfo'] = $this->OA_Finance->getCollectInfo($cid);
		$data['order_collection_type'] = $this->config->item('order_collection_type');
		$data['order_payment_type'] = $this->config->item('order_payment_type');
		$data['typeMsg'] = '收款';
		$this->showView('financeCollection', $data);
	}

	/**
	 *
	 * 收款逻辑
	 */
	public function doCollection()
	{
		$data = array();
		if(checkRight('finance_collect') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$data = $this->input->post();
		$this->load->model('OA_Finance');
		$data['payment_time'] = strtotime('now');
		$data['collection_status'] = 2;
		$collectInfo = $this->OA_Finance->getCollectInfo($data['collection_id']);
		$msg = '';
		if($this->OA_Finance->updateCollection($data) === FALSE){
			$msg = '?msg='.urlencode('收款失败');
			redirect(formatUrl('finance/collect'.$msg));
		}else{
			$this->load->model('OA_Order');
			if($collectInfo['collection_type']==2){
				//修改订单状态
			    $updateOrder['order_id'] = $collectInfo['order_id'];
			    $updateOrder['order_status'] = 4;
			    $this->OA_Order->update($updateOrder);
			}
			redirect(formatUrl('finance/prncollection?cid='.$data['collection_id']));
		}
	}



	/**
	 *
	 * 出票
	 */
	public function prncollection()
	{
		$data = array();
		if(checkRight('finance_collect') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$data['typeMsg'] = '打印';
		$cid = $this->input->get('cid');
		$data['collection_id'] = $cid;
		$this->load->model('OA_Finance');
		$data['collectInfo'] = $this->OA_Finance->getCollectInfo($cid);
		$data['order_collection_type'] = $this->config->item('order_collection_type');
		$data['order_payment_type'] = $this->config->item('order_payment_type');
		$data['customer_service_type'] = $this->config->item('customer_service_type');
		$data['order_fee_unit'] = $this->config->item('order_fee_unit');
		$data['order_service_mode'] = $this->config->item('order_service_mode');
		$data['amount_capitalized'] = get_amount_capitalized($data['collectInfo']['collection_amount']);
		$this->showView('financeCollectionPrn', $data);
	}

	/**
	 * 取消收款
	 */
	public function cancelCollect()
	{
		if($this->input->get('coid')){
			$data['collection_id'] = $this->input->get('coid');
		}else{
			$data['status'] = -1;
		    $this->send_json($data);
		    return;
		}
		$this->load->model('OA_Finance');
		$data['collection_status'] = 3;
		$this->OA_Finance->cancollect($data);
		$collection_status = $this->config->item('order_collection_status');
		$data['collection_status'] = $collection_status[3];
		$data['status'] = 1;
		$this->send_json($data);
	}

	/**
	 *
	 * 票据管理
	 */
	public function bill()
	{
		$data = array();
		if(checkRight('finance_bill') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$this->load->model('OA_Finance');
		if($this->input->post()){
			$dataList = $this->OA_Finance->searchBill($this->input->post());
		}else{
			$offset = 0;
			$pageUrl = '';
			page(formatUrl('finance/bill').'?', $this->OA_Finance->getBillCount(), PER_COUNT, $offset, $pageUrl);
			$dataList = $this->OA_Finance->getBill($offset, PER_COUNT);
			$data['pageUrl'] = $pageUrl;
		}
		$this->load->model('OA_Hospital');
		$hospital = $this->OA_Hospital->queryByPid(0);
		$data['hospitalInfo'] = $hospital;
		foreach($hospital as $h){
			$stationary[$h['wb_id']] = $h['stationary_name'];
		}
		$data['dataList'] = $dataList;
		$data['stationary'] = $stationary;
		$this->showView('financeBill', $data);
	}

	/**
	 *
	 * 添加票据领取
	 */
	public function addbill()
	{
		$data = array();
		$hospital = array();
		$this->load->model('OA_Hospital');
		$hospital = $this->OA_Hospital->queryByPid(0);
		if(checkRight('bill_add') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$data['typeMsg'] = '新增';
		$data['hospitalInfo'] = $hospital;
		$this->showView('financeAddbill', $data);
	}

	/**
	 *
	 * 添加票据领取逻辑
	 */
	public function doAddbill()
	{
		$data = array();
		$data = $this->input->post();
		$this->load->model('OA_Finance');
		$data['received_date'] = strtotime($_POST['received_date']);
		if(checkRight('bill_add') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$msg = '';
		if($this->OA_Finance->addbill($data) === FALSE){
			$msg = '?msg='.urlencode('创建失败');
		}
		redirect(formatUrl('finance/bill'.$msg));
	}

	/**
	 *
	 * 删除
	 */
	public function doDelbill()
	{
		$data = array();
		if(checkRight('bill_del') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$bid = $this->input->get('bid');
		//删除用户信息
		$this->load->model('OA_Finance');
		$this->OA_Finance->delbill($bid);
		redirect(formatUrl('finance/bill'));
	}

	/**
	 * 作废票据
	 */
	public function cancelBill()
	{
		$bid = $num = 0;
		if($this->input->get('bid')){
			$data['bill_id'] = $this->input->get('bid');
		}
		$this->load->model('OA_Finance');
		$bill = $this->OA_Finance->searchBill($data);
		if(empty($bill)){
			$data['status'] = -1;
		    $this->send_json($data);
		    return;
		}
		if($this->input->get('num')){
			$data['canceled_num'] = $this->input->get('num');
			$data['canceled_num'] += $bill[0]['canceled_num'];
			if($bill[0]['bill_num']-$bill[0]['used_num']<$data['canceled_num']){
				$data['status'] = 2;
		        $this->send_json($data);
		        return;
			}
		}else{
			$data['status'] = -1;
		    $this->send_json($data);
		    return;
		}
		$this->OA_Finance->canbill($data);
		$data['status'] = 1;
		$this->send_json($data);
	}

	/**
	 *
	 * 出票
	 */
	public function confirmBill()
	{
		$data = array();
		if(checkRight('bill_add') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$billno = $this->input->get('billno');
		$data['collection_id'] = $this->input->get('coid');
		$this->load->model('OA_Finance');
		$msg = '';
		$data['bill_status'] = 2;
		$data['bill_no'] = $billno;
		if($this->OA_Finance->updateCollection($data) === FALSE){
			$msg = '?msg='.urlencode('出票失败');
			redirect(formatUrl('finance/collect'.$msg));
		}else{
			$this->OA_Finance->useBill($billno);
		    redirect(formatUrl('finance/collect'));
		}
	}

	/**
	 * 对账管理
	 */
	 public function balance()
	{
		$data = $dataList = $month = $postdata = $allmonths = array();
		if(checkRight('finance_balance') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$this->load->model('OA_Finance');
		$postdata = $this->input->post();
		$dataList = $this->OA_Finance->sumSalary($postdata);
		foreach($dataList as $v){
			$allmonths[] = $v['months'];
		}
		$this->load->model('OA_Hospital');
	 	$hospital = $this->OA_Hospital->queryByPid(0);
		$data['dataList'] = $dataList;
		if(!empty($allmonths)){
			$allmonths = array_unique($allmonths);
		}
		$data['allmonths'] = $allmonths;
		$data['hospitalInfo'] = $hospital;
		$this->showView('financeBalance', $data);
	}

	/**
	 *
	 * 详情页面
	 */
	public function balancedetail()
	{
		$data = array();
		if(checkRight('finance_balance') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$wid = $this->input->get('wid');
		$data['wid'] = $wid;
		$months = $this->input->get('months');
		$this->load->model('OA_Finance');
		$data['salaryInfo'] = $this->OA_Finance->getSalaryInfo($wid,$months);
		$this->load->model('OA_Hospital');
		$data['nInfo'] = $this->OA_Hospital->getNameList();
		$data['order_collection_type'] = $this->config->item('order_collection_type');
		$data['order_payment_type'] = $this->config->item('order_payment_type');
		$data['customer_service_type'] = $this->config->item('customer_service_type');
		$data['order_fee_unit'] = $this->config->item('order_fee_unit');
		$data['order_service_mode'] = $this->config->item('order_service_mode');
		$this->showView('financeBalanceDetail', $data);
	}

}