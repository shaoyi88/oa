<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customerservice extends OA_Controller
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}

	/**
	 *
	 * 咨客首页
	 */
	public function index()
	{
		$data = $undeal = array();
		$this->load->model('OA_Admin');
		$role = $this->config->item('customerservice_role');
		$dataList = $this->OA_Admin->queryAdminByRole($role);
		$this->load->model('OA_Department');
		$dpname = $this->OA_Department->getDepartmentName();
		$data['dataList'] = $dataList;
		$data['dpname'] = $dpname;
		$this->load->model('OA_Customerservice');
		$key['cs_status'] = 2;
		$csList = $this->OA_Customerservice->searchCs($key);
		foreach($csList as $val){
			if(!empty($val['appointed'])){
				if(!isset($undeal[$val['appointed']])){
				    $undeal[$val['appointed']] = 1;
			    }else{
				    $undeal[$val['appointed']]++;
			    }
			}
		}
		$data['undeal'] = $undeal;
		$this->showView('customerserviceAdmin', $data);
	}

	/**
	 *
	 * 客服问题
	 */
	public function record()
	{
		$data = array();
		if(checkRight('customer_service_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$this->load->model('OA_Customerservice');
		if($this->input->post()){
			$dataList = $this->OA_Customerservice->searchCs($this->input->post());
		}else{
			$offset = 0;
			$pageUrl = '';
			page(formatUrl('customerservice/record').'?', $this->OA_Customerservice->getCsCount(), PER_COUNT, $offset, $pageUrl);
			$dataList = $this->OA_Customerservice->getCs($offset, PER_COUNT);
			$data['pageUrl'] = $pageUrl;
		}
		$data['dataList'] = $dataList;
		$data['cstype'] = $this->config->item('customerservice_type');
		$data['csstatus'] = $this->config->item('customerservice_status');
		$data['admin'] = $this->session->userdata('admin_name');
		$this->load->model('OA_Admin');
		$role = $this->config->item('customerservice_role');
		$data['cslist'] = $this->OA_Admin->queryAdminByRole($role);
		$this->showView('customerserviceList', $data);
	}

	/**
	 *
	 * 增加/编辑客服问题
	 */
	public function add()
	{
		$data = array();
		if($this->input->get('id')){
			if(checkRight('customer_service_record') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$id = $this->input->get('id');
			$data['typeMsg'] = '编辑/处理';
			$this->load->model('OA_Customerservice');
			$data['info'] = $this->OA_Customerservice->getCsInfo($id);
			$data['csstatus'] = $this->config->item('customerservice_status');
		}else{
			if(checkRight('customer_service_record') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data['typeMsg'] = '新增';
		}
		$this->load->model('OA_Admin');
		$role = $this->config->item('customerservice_role');
		$data['cslist'] = $this->OA_Admin->queryAdminByRole($role);
        $data['cstype'] = $this->config->item('customerservice_type');
        $data['serviceTypeInfo'] = $this->config->item('customer_service_type');
		$data['order_service_mode'] = $this->config->item('order_service_mode');
		$data['order_fee_unit'] = $this->config->item('order_fee_unit');
		$data['order_status'] = $this->config->item('order_status');
		$this->showView('customerserviceAdd', $data);
	}

	/**
	 *
	 * 增加/编辑逻辑
	 */
	public function doAdd()
	{
		$data = array();
		$data = $this->input->post();
		$this->load->model('OA_Customerservice');
		if(isset($data['id'])&&is_numeric($data['id'])){
			if(checkRight('customer_service_record') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			if($data['cs_status']==1&&$data['appointed']){
			    $data['cs_status'] = 2;
			}
			$this->OA_Customerservice->update($data);
			redirect(formatUrl('customerservice/record'));
		}else{
			if(checkRight('customer_service_record') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$msg = '';
			$data['cs_no'] = strtotime('now').rand(100000,999999);
			$data['added_time'] = strtotime('now');
			$data['added_by'] = $this->session->userdata('admin_name');
			if($data['appointed']){
				$data['cs_status'] = 2;
			}
			if($this->OA_Customerservice->add($data) === FALSE){
				$msg = '?msg='.urlencode('创建失败');
			}
			redirect(formatUrl('customerservice/record'.$msg));
		}
	}

	/**
	 *
	 * 删除
	 */
	public function doDel()
	{
		$data = array();
		if(checkRight('customer_service_record') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$id = $this->input->get('id');
		//删除客服问题
		$this->load->model('OA_Customerservice');
		$this->OA_Customerservice->del($id);
		redirect(formatUrl('customerservice/record'));
	}

	/**
	 *
	 * 详情页面
	 */
	public function detail()
	{
		$data = array();
		if(checkRight('customer_service_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$id = $this->input->get('id');
		$data['id'] = $id;
		$this->load->model('OA_Customerservice');
		$data['info'] = $this->OA_Customerservice->getCsInfo($id);
		$data['csstatus'] = $this->config->item('customerservice_status');
		$data['cstype'] = $this->config->item('customerservice_type');
		$data['typeMsg'] = '详情';
		$data['serviceTypeInfo'] = $this->config->item('customer_service_type');
		$data['order_service_mode'] = $this->config->item('order_service_mode');
		$data['order_fee_unit'] = $this->config->item('order_fee_unit');
		$data['order_status'] = $this->config->item('order_status');
		$this->showView('customerserviceDetail', $data);
	}

	public function trace(){
		$data = $postdata = array();
		if(checkRight('customer_service_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$this->load->model('OA_Admin');
		$this->load->model('OA_Customerservice');
		$postdata = $this->input->post();
		$dataList = $this->OA_Customerservice->searchCs($postdata);
		$stat = $stattype = array();
		$role = $this->config->item('customerservice_role');
		$data['cslist'] = $this->OA_Admin->queryAdminByRole($role);
		foreach($data['cslist'] as $da){
			$stat[$da['admin_name']] = array();
		}
		foreach($dataList as $val){
			if(!isset($stat[$val['added_by']][$val['cs_type']]['add'])){
				$stat[$val['added_by']][$val['cs_type']]['add'] = 1;
			}else{
				$stat[$val['added_by']][$val['cs_type']]['add']++;
			}
			if(!empty($val['appointed'])){
				if(!isset($stat[$val['appointed']][$val['cs_type']]['app'])){
				    $stat[$val['appointed']][$val['cs_type']]['app'] = 1;
			    }else{
				    $stat[$val['appointed']][$val['cs_type']]['app']++;
			    }
			}
			$stattype[] = $val['cs_type'];
		}
		if($postdata['cssingle']){
			//查询时如果选择客服则仅显示该客服的数据
            $singlestat = $stat[$postdata['cssingle']];
            $stat = array();
            $stat[$postdata['cssingle']] = $singlestat;
		}
		$data['dataList'] = $dataList;
		$data['stat'] = $stat;
		$data['stattype'] = $stattype;
		$data['cstype'] = $this->config->item('customerservice_type');
		$data['csstatus'] = $this->config->item('customerservice_status');
		$data['admin'] = $this->session->userdata('admin_name');
		$this->showView('customerserviceTrace', $data);
	}
	/*
	 * 统计分析
	 *
	*/
	public function statistical(){
		$data = $postdata = array();
		if(checkRight('customer_service_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$this->load->model('OA_Customerservice');
		$postdata = $this->input->post();
		if(!empty($postdata['sdate'])&&!empty($postdata['edate'])){
            $d1 = strtotime($postdata['sdate']);
            $d2 = strtotime($postdata['edate']);
            $Days = ($d2-$d1)/86400;
		}
		$dataList = $this->OA_Customerservice->searchCs($postdata);
		$stat = $stattype = $xy = array();
		foreach($dataList as $val){
			if(isset($Days)&&$Days<=31){
			    if(!isset($stat[date('d',$val['added_time'])][$val['cs_type']])){
				   $stat[date('m月d日',$val['added_time'])][$val['cs_type']] = 1;
			    }else{
				   $stat[date('m月d日',$val['added_time'])][$val['cs_type']]++;
			    }
			}else{
				if(!isset($stat[date('m',$val['added_time'])][$val['cs_type']])){
				   $stat[date('m月',$val['added_time'])][$val['cs_type']] = 1;
			    }else{
				   $stat[date('m月',$val['added_time'])][$val['cs_type']]++;
			    }
			}
			$stattype[] = $val['cs_type'];
  		}
		$cstype = $this->config->item('customerservice_type');
		$y = $xsets = array();
		foreach($stat as $k=>$v){
			$xsets[] = $k;
			foreach($stattype as $d){
				if(isset($v[$d])){
					$y[$d][] = $v[$d];
				}else{
					$y[$d][] = 0;
				}
			}
		}
		$ytxt = '[';
		foreach($y as $key=>$ys){
			$ytxt .= '{name: "'.$cstype[$key].'",data: '.json_encode($ys).',},';
		}
		$xy[0] = json_encode($xsets);
		$xy[1] = $ytxt.']';
		$data['xy'] = $xy;
		$data['dataList'] = $stat;;
		$data['cstype'] = $cstype;
		$data['csstatus'] = $this->config->item('customerservice_status');
		$this->showView('customerserviceStat', $data);
	}

  	/*
	 * 获取客户相关订单
	 *
	*/
    public function getUserOrder()
	{
		$user_phone = 0;
		if($this->input->get('user_phone')){
			$user_phone = $this->input->get('user_phone');
		}
		$this->load->model('OA_Order');
		$orderInfo = $this->OA_Order->getOrderInfoByUserPhone($user_phone);
		$info = array();
		$data['serviceTypeInfo'] = $this->config->item('customer_service_type');
		$data['order_service_mode'] = $this->config->item('order_service_mode');
		$data['order_fee_unit'] = $this->config->item('order_fee_unit');
		$data['order_status'] = $this->config->item('order_status');
		foreach($orderInfo as $v){
			$v['service_type'] = $data['serviceTypeInfo'][$v['service_type']];
			$v['service_mode'] = $data['order_service_mode'][$v['service_mode']][0];
			$v['order_fee_unit'] = $data['order_fee_unit'][$v['order_fee_unit']];
			$v['order_start_time'] = date('Y-m-d H:i:s',$v['order_start_time']);
			$v['order_end_time'] = $v['order_end_time']?date('Y-m-d H:i:s',$v['order_end_time']):'未结束';
			$v['order_advance_payment'] = $v['order_advance_payment']?$v['order_advance_payment']:'暂无';
			$v['order_total_cost'] = $v['order_total_cost']?$v['order_total_cost']:'未结算';
			$v['order_status'] = $data['order_status'][$v['order_status']];
			$info[] = $v;
		}
		$this->send_json($info);
	}
}