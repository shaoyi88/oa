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
		$data['areasInfo'] = $this->OA_Areas->getAreasNameList();
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
			$service_arr = explode('|',$data['info']['worker_service']);
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
		$data['service'] = $service_arr;
		$data['sexInfo'] = $this->config->item('sex');
		$data['eduInfo'] = $this->config->item('education');
		$data['marriage'] = $this->config->item('marriage');
		$data['title'] = $this->config->item('service_level_1');
		$data['workerStatus'] = $this->config->item('worker_status');
		$data['workerService'] = $this->config->item('customer_service_type');
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
		if(isset($data['worker_service'])){
			$service = $data['worker_service'];
		    if(!empty($service)){
			    $data['worker_service'] = implode('|',$service);
		    }
		}
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
		$worker_service = explode('|',$data['workerInfo']['worker_service']);
		$arr = array();
		foreach($worker_service as $v){
			$arr[] = $data['workerService'][$v];
		}
		$data['worker_service'] = implode('，',$arr);
		$this->load->model('OA_Areas');
		$data['provinceInfo'] = $this->OA_Areas->queryAreasByPid(0);
		$data['areasInfo'] = $this->OA_Areas->getAreasNameList();
		$this->load->model('OA_Hospital');
		$data['nInfo'] = $this->OA_Hospital->getNameList();
		$this->showView('workerDetail', $data);
	}
}