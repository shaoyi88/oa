<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Worker extends OA_Controller
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}

	/**
	 *
	 * 护工首页
	 */
	public function index()
	{
		$data = array();
		if(checkRight('worker_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$this->load->model('OA_Worker');
		if($this->input->post('keyword')){
			$dataList = $this->OA_Worker->searchWorker($this->input->post('keyword'));
		}else{
			$offset = 0;
			$pageUrl = '';
			page(formatUrl('worker/index').'?', $this->OA_Worker->getWorkerCount(), PER_COUNT, $offset, $pageUrl);
			$dataList = $this->OA_Worker->getWorker($offset, PER_COUNT);
			$data['pageUrl'] = $pageUrl;
		}
		$this->load->model('OA_Areas');
		$data['dataList'] = $dataList;
		$data['sexInfo'] = $this->config->item('sex');
		$this->load->model('OA_Hospital');
		$data['nInfo'] = $this->OA_Hospital->getNameList();
		$data['title'] = $this->config->item('service_level_1');
		$this->showView('workerList', $data);
	}

	/**
	 *
	 * 增加/编辑护工页面
	 */
	public function add()
	{
		$data = array();
		$this->load->model('OA_Areas');
		$provinceInfo = $cityInfo = $districtInfo = $hospital = $ninfo = array();
		$provinceInfo = $this->OA_Areas->queryAreasByPid(0);
		$service_arr = '';
		$this->load->model('OA_Hospital');
		$hospital = $this->OA_Hospital->queryByPid(0);
		if($this->input->get('wid')){
			if(checkRight('worker_edit') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$wid = $this->input->get('wid');
			$data['typeMsg'] = '编辑';
			$this->load->model('OA_Worker');
			$data['info'] = $this->OA_Worker->getWorkerInfo($wid);
			if($data['info']['worker_domicile_province']){
				$cityInfo = $this->OA_Areas->queryAreasByPid($data['info']['worker_domicile_province']);
			}
			if($data['info']['worker_domicile_city']){
				$districtInfo = $this->OA_Areas->queryAreasByPid($data['info']['worker_domicile_city']);
			}
            if($data['info']['worker_hospital']){
				$ninfo = $this->OA_Hospital->queryByPid($data['info']['worker_hospital']);
			}
		}else{
			if(checkRight('worker_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data['typeMsg'] = '新增';
		}
		$data['provinceInfo'] = $provinceInfo;
		$data['cityInfo'] = $cityInfo;
		$data['districtInfo'] = $districtInfo;
		$data['sexInfo'] = $this->config->item('sex');
		$data['eduInfo'] = $this->config->item('education');
		$data['marriage'] = $this->config->item('marriage');
		$data['title'] = $this->config->item('service_level_1');
		$data['workerStatus'] = $this->config->item('worker_status');
		$data['workerService'] = $this->config->item('customer_service_type');
		$data['serviceMode'] = $this->config->item('worker_service_mode');
		$data['hospitalInfo'] = $hospital;
		$data['nInfo'] = $ninfo;
		$this->showView('workerAdd', $data);
	}

	/**
	 *
	 * 增加/编辑逻辑
	 */
	public function doAdd()
	{
		$data = array();
		$data = $this->input->post();
		$this->load->model('OA_Worker');
		$cid = $data['worker_idnumber'];
		//从身份证得出生日和年龄
		if(strlen($cid)==15||strlen($cid)==16){
			$data['worker_birthday'] = date('Y-m-d',strtotime('19'.substr($cid,6,6)));
		}else if(strlen($cid)==18||strlen($cid)==19){
			$data['worker_birthday'] = date('Y-m-d',strtotime(substr($cid,6,8)));
		}
		$age = date('Y',time())-date('Y',strtotime($data['worker_birthday']))-1;
        if(date('m',time())==date('m',strtotime($data['worker_birthday']))){
            if(date('d',time())>date('d',strtotime($data['worker_birthday']))){
                $age++;
            }
        }else if(date('m',time())>date('m',strtotime($data['worker_birthday']))){
            $age++;
        }
		$data['worker_age'] = $age;
		if(isset($data['worker_id'])&&is_numeric($data['worker_id'])){
			if(checkRight('worker_edit') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$this->OA_Worker->update($data);
			redirect(formatUrl('worker/index'));
		}else{
			if(checkRight('worker_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$msg = '';
			if($this->OA_Worker->add($data) === FALSE){
				$msg = '?msg='.urlencode('创建失败');
			}
			redirect(formatUrl('worker/index'.$msg));
		}
	}

	/**
	 *
	 * 删除
	 */
	public function doDel()
	{
		$data = array();
		if(checkRight('worker_del') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$wid = $this->input->get('wid');
		//删除用户信息
		$this->load->model('OA_Worker');
		$this->OA_Worker->del($wid);
		redirect(formatUrl('worker/index'));
	}

	/**
	 *
	 * 详情页面
	 */
	public function detail()
	{
		$data = array();
		if(checkRight('worker_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$hideTitle = FALSE;
		if($this->input->get('hideTitle')){
			$hideTitle = TRUE;;
		}
		$data['hideTitle'] = $hideTitle;
		$wid = $this->input->get('wid');
		$data['wid'] = $wid;
		$this->load->model('OA_Worker');
		$data['workerInfo'] = $this->OA_Worker->getWorkerInfo($wid);
		$data['sexInfo'] = $this->config->item('sex');
		$data['marriage'] = $this->config->item('marriage');
		$data['eduInfo'] = $this->config->item('education');
		$data['title'] = $this->config->item('service_level_1');
		$data['workerStatus'] = $this->config->item('worker_status');
		$data['workerService'] = $this->config->item('customer_service_type');
		$this->load->model('OA_Areas');
		$data['provinceInfo'] = $this->OA_Areas->queryAreasByPid(0);
		$ids = array();
		$ids[] = $data['workerInfo']['worker_domicile_province'];
		$ids[] = $data['workerInfo']['worker_domicile_city'];
		$ids[] = $data['workerInfo']['worker_domicile_district'];
		$data['areasInfo'] = $this->OA_Areas->getAreasNameListByIds($ids);
		$this->load->model('OA_Hospital');
		$data['nInfo'] = $this->OA_Hospital->getNameList();
		$this->showView('workerDetail', $data);
	}

	/**
	 * 统计页面
	 */
	 public function statis(){
	 	$data = $hospital = $ninfo = $statinfo = $staHospital = $staWs = $sta = array();
	 	if(checkRight('worker_stat') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
	 	$data['wsInfo'] = $this->config->item('worker_status');
	 	$this->load->model('OA_Worker');
	 	$postdata = $this->input->post();
		$dataList = $this->OA_Worker->statWorker($postdata);
	 	$this->load->model('OA_Hospital');
	 	$hospital = $this->OA_Hospital->queryByPid(0);
	 	$staHospital = $hospital;
	 	foreach($hospital as $h){
	        $ninfo[$h['wb_id']] = $this->OA_Hospital->queryByPid($h['wb_id']);
	 	}
	 	//查询指定医院
	 	if(!empty($postdata['worker_hospital'])){
	 		$temp = array();
	 		$temp = $ninfo[$postdata['worker_hospital']];
	 		$ninfo = array();
	 		$ninfo[$postdata['worker_hospital']] = $temp;
	 		$staHospital = array();
	 		$staHospital[] = $this->OA_Hospital->getHospitalInfo($postdata['worker_hospital']);
	 	}
	 	//查询指定科室
	 	if(!empty($postdata['worker_stationary'])){
	 		$temp = array();
	 		$temp = $this->OA_Hospital->getHospitalInfo($postdata['worker_stationary']);;
	 		$ninfo = array();
	 		$ninfo[$temp['parent_id']][] = $temp;
	 		$staHospital = array();
	 		$staHospital[] = $this->OA_Hospital->getHospitalInfo($postdata['worker_hospital']);
	 	}
	 	foreach($data['wsInfo'] as $k=>$ws){
	 		$sta['wk'] = $k;
	 		$sta['ws'] = $ws;
	 		$staWs[] = $sta;
	 	}
	 	//查询指定状态
	 	if(!empty($postdata['worker_status'])){
	 		$staWs = array();
	 		$sta['wk'] = $postdata['worker_status'];
	 		$sta['ws'] = $data['wsInfo'][$postdata['worker_status']];
	 		$staWs[] = $sta;
	 	}
	 	foreach($dataList as $val){
	 		//各驻点医院护工数小结
	 		if(!isset($sum[$val['worker_hospital']])){
	 			$sum[$val['worker_hospital']] = 1;
	 		}else{
	 			$sum[$val['worker_hospital']] ++;
	 		}
	 		//各科室护工各个服务状态人数
	 		if(!isset($statinfo[$val['worker_stationary']][$val['worker_status']])){
	 			$statinfo[$val['worker_stationary']][$val['worker_status']] = 1;
	 		}else{
	 			$statinfo[$val['worker_stationary']][$val['worker_status']]++;
	 		}
	 	}
	 	$data['hospitalInfo'] = $hospital;
	 	$data['staHospital'] = $staHospital;
	 	$data['staWs'] = $staWs;
		$data['nInfo'] = $ninfo;
		$data['total'] = $this->OA_Worker->getWorkerCount();
		$data['sum'] = $sum;
		$data['statInfo'] = $statinfo;
		$this->showView('workerStat', $data);
	 }

	 /**
	  * 评价统计
	  */
	   public function comment(){
	   	 $data = $hospital = $ninfo = $workernum = $sum = $comment = $stacom = $comn = $stahos = $comh = array();
	   	 if(checkRight('worker_comment') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
	   	 $this->load->model('OA_Worker');
		 $dataList = $this->OA_Worker->statWorker($arr=array());
		 $this->load->model('OA_Hospital');
	 	 $hospital = $this->OA_Hospital->queryByPid(0);
	 	 foreach($hospital as $h){
	        $ninfo[$h['wb_id']] = $this->OA_Hospital->queryByPid($h['wb_id']);
	 	 }
	 	 foreach($dataList as $val){
	 	 	if(!isset($sum[$val['worker_hospital']])){
	 			$sum[$val['worker_hospital']] = 1;
	 		}else{
	 			$sum[$val['worker_hospital']] ++;
	 		}
	 		if(!isset($workernum[$val['worker_stationary']])){
	 			$workernum[$val['worker_stationary']] = 1;
	 		}else{
	 			$workernum[$val['worker_stationary']]++;
	 		}
	 	}
	 	$comment = $this->OA_Worker->statComment();
	 	$totalcom = 0;
	 	$totaln = 0;
	 	foreach($comment as $v){
	 		//医院评价小结
	 		if(!isset($stahos[$v['worker_hospital']])){
	 		    $stahos[$v['worker_hospital']] = $v['sumle'];
	 		}else{
	 			$stahos[$v['worker_hospital']] += $v['sumle'];
	 		}
	 		if(!isset($comh[$v['worker_hospital']])){
	 		    $comh[$v['worker_hospital']] = $v['ccw'];
	 		}else{
	 			$comh[$v['worker_hospital']] += $v['ccw'];
	 		}
	 		//科室评价小结
	 		if(!isset($stacom[$v['worker_stationary']])){
	 		    $stacom[$v['worker_stationary']] = $v['sumle'];
	 		}else{
	 			$stacom[$v['worker_stationary']] += $v['sumle'];
	 		}
	 		if(!isset($comn[$v['worker_stationary']])){
	 		    $comn[$v['worker_stationary']] = $v['ccw'];
	 		}else{
	 			$comn[$v['worker_stationary']] += $v['ccw'];
	 		}
	 		//汇总
	 		$totalcom += $v['sumle'];
	 		$totaln += $v['ccw'];
	 	}
		$data['hospital'] = $hospital;
		$data['nInfo'] = $ninfo;
		$data['total'] = $this->OA_Worker->getWorkerCount();
		$data['sum'] = $sum;
		$data['workernum'] = $workernum;
		$data['stacom'] = $stacom;
		$data['stahos'] = $stahos;
		$data['comn'] = $comn;
		$data['comh'] = $comh;
		$data['totalcom'] = sprintf("%.2f",$totalcom/$totaln);
	    $this->showView('workerComment', $data);
	   }
}