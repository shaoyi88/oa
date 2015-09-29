<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hospital extends OA_Controller
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}

	/**
	 *
	 * 获取子部门
	 */
	public function getDepartment()
	{
		$pid = 0;
		if($this->input->get('pid')){
			$pid = $this->input->get('pid');
		}
		$this->load->model('OA_Hospital');
		$departmentInfo = $this->OA_Hospital->queryByPid($pid);
		$this->send_json($departmentInfo);
	}
	 /**
	 *
	 * 驻点医院首页
	 */
	public function index()
	{
		$data = array();
		if(checkRight('hospital_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$this->load->model('OA_Hospital');
		if($this->input->post('keyword')){
			$dataList = $this->OA_Hospital->searchHospital($this->input->post('keyword'));
		}else{
			$offset = 0;
			$pageUrl = '';
			page(formatUrl('hospital/index').'?', $this->OA_Hospital->getHospitalCount(), PER_COUNT, $offset, $pageUrl);
			$dataList = $this->OA_Hospital->getHospital($offset, PER_COUNT);
			$data['pageUrl'] = $pageUrl;
		}
		$ninfo = array();
		foreach($dataList as $v){
			if($v['parent_id']==0){
				$ninfo[$v['wb_id']] = $this->OA_Hospital->queryByPid($v['wb_id']);
			}else{
				$ninfo[$v['parent_id']] = $this->OA_Hospital->queryByPid($v['parent_id']);
			}
		}
		$data['hospital'] = $this->OA_Hospital->getNameList();
		$data['dataList'] = $ninfo;
		$this->showView('hospitalList', $data);
	}

	/**
	 *
	 * 添加驻点医院
	*/
	public function add()
	{
		$data = array();
		$this->load->model('OA_Hospital');
		$nInfo = array();
		$hospital = $this->OA_Hospital->queryByPid(0);
		if($this->input->get('hid')){
			if(checkRight('hospital_edit') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$hid = $this->input->get('hid');
			$data['typeMsg'] = '编辑';
			$data['info'] = $this->OA_Hospital->getHospitalInfo($hid);
			$data['nInfo'] = $this->OA_Hospital->queryByPid($hid);
			if($data['info']['parent_id']>0){
				$data['nInfo'] = $this->OA_Hospital->queryByPid($data['info']['parent_id']);
				$data['info'] = $this->OA_Hospital->getHospitalInfo($data['info']['parent_id']);
			}
		}else{
			if(checkRight('hospital_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data['typeMsg'] = '新增';
		}
		$data['hospitalInfo'] = $hospital;
		$this->showView('hospitalAdd', $data);
	}

	public function doAdd()
	{
		$data = $starr = $staid = array();
		if($this->input->post('wb_id')){
			if(checkRight('hospital_edit') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data = $this->input->post();
			$hospital['wb_id'] = $data['wb_id'];
			$hospital['stationary_name'] = $data['stationary_name'];
			$this->load->model('OA_Hospital');
			$this->OA_Hospital->update($hospital);
			if(isset($data['staid'])){
				$staid = $data['staid'];
			}
			$this->OA_Hospital->delsta($staid,$data['wb_id']);
			if(isset($data['stationary'])&&!empty($data['stationary'])){
				$starr = $data['stationary'];
				foreach($starr as $k=>$v){
					$upsta = array();
					if(isset($staid[$k])){
						$upsta['wb_id'] = $staid[$k];
						$upsta['stationary_name'] = $v;
						$this->OA_Hospital->update($upsta);
					}else{
						$upsta['stationary_name'] = $v;
						$upsta['parent_id'] = $data['wb_id'];
						$this->OA_Hospital->add($upsta);
					}
				}
			}
			redirect(formatUrl('hospital/index'));
		}else{
			if(checkRight('hospital_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data = $this->input->post();
			$msg = '';
			$this->load->model('OA_Hospital');
			$result = $this->OA_Hospital->add($data);
			if($result === FALSE){
				$msg = '?msg='.urlencode('创建失败');
				redirect(formatUrl('hospital/index'.$msg));
			}else{
				redirect(formatUrl('hospital/add?hid='.$result));
			}
		}
	}

	public function doDel()
	{
		$data = array();
		if(checkRight('hospital_del') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$hid = $this->input->get('wid');
		//删除医院（连同科室一起删除）
		$this->load->model('OA_Hospital');
		$this->OA_Hospital->del($hid);
		redirect(formatUrl('hospital/index'));
	}

	/**驻点医院护工列表
	 *
	 *
	*/
	public function worker(){
		$this->load->model('OA_Hospital');
		$data['hospitalTree'] = $this->OA_Hospital->getListTree(0);
		$workerList = array();
		if(isset($data['hospitalTree'][0]['wb_id'])){
			$pid = $data['hospitalTree'][0]['wb_id'];
			if($this->input->get('pid', TRUE)){
				$pid = $this->input->get('pid', TRUE);
			}
			$subList = $this->OA_Hospital->getListTree($pid, $data['hospitalTree']);
			$idList = array();
			$idList[] = $pid;
			foreach($subList as $item){
				$idList[] = $item['wb_id'];
			}
			$this->load->model('OA_Worker');
			$workerList = $this->OA_Worker->queryWorkerByHospital($idList);
			$data['pid'] = $pid;
		}
		$data['workerList'] = $workerList;
		$data['sexInfo'] = $this->config->item('sex');
		$data['title'] = $this->config->item('service_level_1');
		$this->showView('hospitalworkerList', $data);
	}
}