<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hospitaladvice extends OA_Controller
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}

	/**
	 *
	 * 意见建议跟进人员
	 */
	public function admin()
	{
		$data = $undeal = array();
		$this->load->model('OA_Admin');
		$role = $this->config->item('hospitaladvice_role');
		$dataList = $this->OA_Admin->queryAdminByRole($role);
		$this->load->model('OA_Department');
		$dpname = $this->OA_Department->getDepartmentName();
		$data['dataList'] = $dataList;
		$data['dpname'] = $dpname;
		$this->load->model('OA_Hospitaladvice');
		$key['advice_status'] = 2;
		$csList = $this->OA_Hospitaladvice->searchHp($key);
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
		$this->showView('hospitaladviceAdmin', $data);
	}

	/**
	 *
	 * 意见建议列表
	 */
	public function advice_list()
	{
		$data = array();
		if(checkRight('advice_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$this->load->model('OA_Hospitaladvice');
		if($this->input->post()){
			$dataList = $this->OA_Hospitaladvice->searchHp($this->input->post());
		}else{
			$offset = 0;
			$pageUrl = '';
			page(formatUrl('hospitaladvice/advice_list').'?', $this->OA_Hospitaladvice->getHpCount(), PER_COUNT, $offset, $pageUrl);
			$dataList = $this->OA_Hospitaladvice->getHp($offset, PER_COUNT);
			$data['pageUrl'] = $pageUrl;
		}
		$data['dataList'] = $dataList;
		$data['hpstatus'] = $this->config->item('hospitaladvice_status');
		$data['admin'] = $this->session->userdata('admin_name');
		$this->load->model('OA_Admin');
		$role = $this->config->item('hospitaladvice_role');
		$data['hplist'] = $this->OA_Admin->queryAdminByRole($role);
		$this->load->model('OA_Hospital');
		$data['nInfo'] = $this->OA_Hospital->getNameList();
		$this->showView('hospitaladviceList', $data);
	}

	/**
	 *
	 * 增加/编辑意见建议
	 */
	public function add()
	{
		$data = $ninfo = array();
		$this->load->model('OA_Hospital');
		$hospital = $this->OA_Hospital->queryByPid(0);
		if($this->input->get('id')){
			if(checkRight('hospitaladvice_add') === FALSE && checkRight('hospitaladvice_follow') === FALSE && checkRight('hospitaladvice_appoint') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$id = $this->input->get('id');
			$data['typeMsg'] = '编辑处理';
			$this->load->model('OA_Hospitaladvice');
			$data['info'] = $this->OA_Hospitaladvice->getHpInfo($id);
			$data['hpstatus'] = $this->config->item('hospitaladvice_status');
			$data['appointright'] = checkRight('hospitaladvice_appoint');
			if($data['info']['hospital_id']){
				$ninfo = $this->OA_Hospital->queryByPid($data['info']['hospital_id']);
			}
		}else{
			if(checkRight('hospitaladvice_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data['typeMsg'] = '新增';
		}
		$this->load->model('OA_Admin');
		$role = $this->config->item('hospitaladvice_role');
		$data['hplist'] = $this->OA_Admin->queryAdminByRole($role);
		$data['hospitalInfo'] = $hospital;
		$data['nInfo'] = $ninfo;
		$this->showView('hospitaladviceAdd', $data);
	}

	/**
	 *
	 * 增加/编辑逻辑
	 */
	public function doAdd()
	{
		$data = array();
		$data = $this->input->post();
		$this->load->model('OA_Hospitaladvice');
		if(isset($data['advice_id'])&&is_numeric($data['advice_id'])){
			if(checkRight('hospitaladvice_add') === FALSE && checkRight('hospitaladvice_follow') === FALSE && checkRight('hospitaladvice_appoint') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			if(isset($data['appointed'])&&$data['appointed']){
			    $data['advice_status'] = 2;
			}
			if(isset($data['feedback_content'])){
				$savedata['advice_id'] = $data['advice_id'];
				$savedata['feedback_content'] = $data['feedback_content'];
				$savedata['advice_status'] = $data['advice_status'];
				$savedata['feedback_time'] = strtotime('now');
				$this->OA_Hospitaladvice->update($savedata);
			}else{
				$this->OA_Hospitaladvice->update($data);
			}
			redirect(formatUrl('hospitaladvice/advice_list'));
		}else{
			if(checkRight('hospitaladvice_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$msg = '';
			$data['added_time'] = strtotime('now');
			$data['added_by'] = $this->session->userdata('admin_name');
			if($this->OA_Hospitaladvice->add($data) === FALSE){
				$msg = '?msg='.urlencode('创建失败');
			}
			redirect(formatUrl('hospitaladvice/advice_list'.$msg));
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
		$data['workerInfo'] = $this->OA_Customerservice->getCsInfo($id);
		$data['csStatus'] = $this->config->item('customerservice_status');
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
		$this->load->model('OA_Customerservice');
		$postdata = $this->input->post();
		$dataList = $this->OA_Customerservice->searchCs($postdata);
		$stat = $stattype = array();
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
		$this->load->model('OA_Admin');
		$role = $this->config->item('customerservice_role');
		$data['cslist'] = $this->OA_Admin->queryAdminByRole($role);
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
}