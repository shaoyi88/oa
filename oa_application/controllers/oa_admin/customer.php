<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends OA_Controller 
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}
	
	/**
	 * 
	 * 客户首页
	 */
	public function index()
	{
		$data = array();
		if(checkRight('customer_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$this->load->model('OA_Customer');
		if($this->input->post('keyword')){
			$dataList = $this->OA_Customer->queryCustomerByKey($this->input->post('keyword'), $this->hospitalId);
		}else{
			$offset = 0;
			$pageUrl = '';
			page(formatUrl('customer/index').'?', $this->OA_Customer->getCustomerCount($this->hospitalId), PER_COUNT, $offset, $pageUrl);
			$dataList = $this->OA_Customer->getCustomer($offset, PER_COUNT, $this->hospitalId);
			$data['pageUrl'] = $pageUrl;
		}
		$data['dataList'] = $dataList;		
		$data['sexInfo'] = $this->config->item('sex');
		$data['groupInfo'] = $this->config->item('customer_group');
		$data['serviceTypeInfo'] = $this->config->item('customer_service_type');
		$data['serviceLevel1'] = $this->config->item('service_level_1');
		$data['serviceLevel2'] = $this->config->item('service_level_2');
		$this->showView('customerList', $data);
	}
	
	/**
	 * 
	 * 增加/编辑客户页面
	 */
	public function add()
	{
		$data = array();
		$this->load->model('OA_Hospital');	
		$hospitalInfo = $departmentInfo = array();
		$hospitalInfo = $this->OA_Hospital->queryByPid(0);	
		if($this->input->get('cid')){
			if(checkRight('customer_edit') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$cid = $this->input->get('cid');
			$data['typeMsg'] = '编辑';
			$this->load->model('OA_Customer');
			$data['info'] = $this->OA_Customer->getCustomerInfo($cid);
			if($data['info']['customer_hospital']){
				$departmentInfo = $this->OA_Hospital->queryByPid($data['info']['customer_hospital']);	
			}
		}else{
			if(checkRight('customer_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data['typeMsg'] = '新增';
		}
		if($this->hospitalId != 0){
			$hospitalName = $this->OA_Hospital->getNameList();
			$data['curHospital'] = $this->hospitalId;
			$data['curHospitalName'] = $hospitalName[$this->hospitalId];
			$data['curNInfo'] = $this->OA_Hospital->queryByPid($this->hospitalId);
		}
		$data['hospitalInfo'] = $hospitalInfo;
		$data['departmentInfo'] = $departmentInfo;
		$data['sexInfo'] = $this->config->item('sex');
		$data['languageInfo'] = $this->config->item('customer_language');
		$data['groupInfo'] = $this->config->item('customer_group');
		$data['serviceTypeInfo'] = $this->config->item('customer_service_type');
		$data['hobbyTypeInfo'] = $this->config->item('hobby_type');
		$data['stateType'] = $this->config->item('state_type');
		$data['selfcareAbilityType'] = $this->config->item('selfcare_ability');
		$data['serviceLevel1'] = $this->config->item('service_level_1');
		$data['serviceLevel2'] = $this->config->item('service_level_2');
		$this->showView('customerAdd', $data);
	}
	
	/**
	 * 
	 * 增加/编辑逻辑
	 */
	public function doAdd()
	{
		$data = array();
		if($this->input->post('customer_id')){
			if(checkRight('customer_edit') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data = $this->input->post();
			$data['customer_language'] = $data['customer_language'] == '其他' ? $data['other_language'] : $data['customer_language'];
			if(isset($data['customer_hobby'])){
				$data['customer_hobby'] = $data['customer_hobby'] == '其他' ? $data['other_hobby'] : $data['customer_hobby'];
			}
			if(isset($data['customer_state'])){
				$data['customer_state'] = $data['customer_state'] == '其他' ? $data['other_state'] : $data['customer_state'];
			}
			if($data['customer_service_type'] == 4){
				$data['customer_service_level'] = $data['customer_service_level2'];
			}else{
				$data['customer_service_level'] = $data['customer_service_level1'];
			}
			unset($data['customer_service_level1']);
			unset($data['customer_service_level2']);
			unset($data['other_language']);
			unset($data['other_hobby']);
			unset($data['other_state']);
			$this->load->model('OA_Customer');
			$this->OA_Customer->update($data);
			redirect(formatUrl('customer/index'));
		}else{
			if(checkRight('customer_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data = $this->input->post();
			$data['customer_language'] = $data['customer_language'] == '其他' ? $data['other_language'] : $data['customer_language'];
			if(isset($data['customer_hobby'])){
				$data['customer_hobby'] = $data['customer_hobby'] == '其他' ? $data['other_hobby'] : $data['customer_hobby'];
			}
			if(isset($data['customer_state'])){
				$data['customer_state'] = $data['customer_state'] == '其他' ? $data['other_state'] : $data['customer_state'];
			}
			if($data['customer_service_type'] == 4){
				$data['customer_service_level'] = $data['customer_service_level2'];
			}else{
				$data['customer_service_level'] = $data['customer_service_level1'];
			}
			unset($data['customer_service_level1']);
			unset($data['customer_service_level2']);
			unset($data['other_language']);
			unset($data['other_hobby']);
			unset($data['other_state']);
			$msg = '';
			$this->load->model('OA_Customer');
			if($this->OA_Customer->add($data) === FALSE){
				$msg = '?msg='.urlencode('创建失败');
			}
			redirect(formatUrl('customer/index'.$msg));
		}
	}
	
	/**
	 * 
	 * 获取客户
	 */
	public function getCustomer()
	{
		if($this->input->get('key')){
			$key = $this->input->get('key');
		}
		$this->load->model('OA_Customer');
		$customerList = $this->OA_Customer->queryCustomerByKey($key, $this->hospitalId);	
		if(empty($customerList)){			
			$this->send_json(array('status'=>0));
		}else{
			$this->send_json(array('status'=>1,'customerList'=>$customerList));
		}
	}
	
	/**
	 * 
	 * 删除
	 */
	public function doDel()
	{
		$data = array();
		if(checkRight('customer_del') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$cid = $this->input->get('cid');
		//删除客户信息
		$this->load->model('OA_Customer');
		$this->OA_Customer->del($cid);
		//删除关注人信息
		$this->load->model('OA_Follow');
		$this->OA_Follow->delByCid($cid);
		redirect(formatUrl('customer/index'));
	}
	
	/**
	 * 
	 * 详情页面
	 */
	public function detail()
	{
		$data = array();
		if(checkRight('customer_list') === FALSE){
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
		$cid = $this->input->get('cid');
		$data['cid'] = $cid;
		$this->load->model('OA_Customer');
		$data['customerInfo'] = $this->OA_Customer->getCustomerInfo($cid);
		$data['sexInfo'] = $this->config->item('sex');
		$this->load->model('OA_Follow');
		$data['followInfo'] = $this->OA_Follow->queryFollowByCid($cid);
		$data['groupInfo'] = $this->config->item('customer_group');
		$data['serviceTypeInfo'] = $this->config->item('customer_service_type');
		$data['serviceLevel1'] = $this->config->item('service_level_1');
		$data['serviceLevel2'] = $this->config->item('service_level_2');
		$this->load->model('OA_Hospital');	
		$data['hospitalInfo'] = $this->OA_Hospital->getNameList();
		$this->showView('customerDetail', $data);
	}
	
	/**
	 * 
	 * 统计
	 */
	public function stat()
	{
		$data = array();
		if(checkRight('customer_stat') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		//初始化变量
		$data = $this->input->post();
		$data['groupInfo'] = $this->config->item('customer_group');
		$data['serviceTypeInfo'] = $this->config->item('customer_service_type');
		$this->load->model('OA_Hospital');	
		$data['hospitalNameInfo'] = $this->OA_Hospital->getNameList();
		$data['hospitalInfo'] = $this->OA_Hospital->queryByPid(0);	
		if(!empty($data['customer_hospital'])){
			$data['departmentInfo'] = $this->OA_Hospital->queryByPid($data['customer_hospital']);	
		}
		//客户统计
		$this->load->model('OA_Customer');
		$statInfo = $this->OA_Customer->stat($data);
		$customerTypeNum = $customerHospitalNum = $customerHospitalDepartmentNum = array();  //统计项行数
		$customerTypeSum = $customerHospitalSum = $customerHospitalDepartmentSum = array();  //统计项小结数
		$sum = 0;
		foreach($statInfo as $item){
			$customerTypeNum[$item['customer_type']] = isset($customerTypeNum[$item['customer_type']]) ? $customerTypeNum[$item['customer_type']]+1 : 1;
			$customerHospitalNum[$item['customer_hospital']] = isset($customerHospitalNum[$item['customer_hospital']]) ? $customerHospitalNum[$item['customer_hospital']]+1 : 1;
			$customerHospitalDepartmentNum[$item['customer_hospital_department']] = isset($customerHospitalDepartmentNum[$item['customer_hospital_department']]) ? $customerHospitalDepartmentNum[$item['customer_hospital_department']]+1 : 1;
			$customerTypeSum[$item['customer_type']] = isset($customerTypeSum[$item['customer_type']]) ? $customerTypeSum[$item['customer_type']]+$item['sum'] : $item['sum'];
			$customerHospitalSum[$item['customer_hospital']] = isset($customerHospitalSum[$item['customer_hospital']]) ? $customerHospitalSum[$item['customer_hospital']]+$item['sum'] : $item['sum'];
			$customerHospitalDepartmentSum[$item['customer_hospital_department']] = isset($customerHospitalDepartmentSum[$item['customer_hospital_department']]) ? $customerHospitalDepartmentSum[$item['customer_hospital_department']]+$item['sum'] : $item['sum'];
			$sum += $item['sum'];
		}
		$data['customerTypeNum'] = $customerTypeNum;
		$data['customerHospitalNum'] = $customerHospitalNum;
		$data['customerHospitalDepartmentNum'] = $customerHospitalDepartmentNum;
		$data['customerTypeSum'] = $customerTypeSum;
		$data['customerHospitalSum'] = $customerHospitalSum;
		$data['customerHospitalDepartmentSum'] = $customerHospitalDepartmentSum;
		$data['sum'] = $sum;
		$data['statInfo'] = $statInfo;
		$this->showView('customerStat', $data);
	}
}