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
			$dataList = $this->OA_Customer->queryCustomerByKey($this->input->post('keyword'));
		}else{
			$offset = 0;
			$pageUrl = '';
			page(formatUrl('customer/index').'?', $this->OA_Customer->getCustomerCount(), PER_COUNT, $offset, $pageUrl);
			$dataList = $this->OA_Customer->getCustomer($offset, PER_COUNT);
			$data['pageUrl'] = $pageUrl;
		}
		$data['dataList'] = $dataList;		
		$data['sexInfo'] = $this->config->item('sex');
		$this->showView('customerList', $data);
	}
	
	/**
	 * 
	 * 增加/编辑客户页面
	 */
	public function add()
	{
		$data = array();	
		if($this->input->get('cid')){
			if(checkRight('customer_edit') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$cid = $this->input->get('cid');
			$data['typeMsg'] = '编辑';
			$this->load->model('OA_Customer');
			$data['info'] = $this->OA_Customer->getCustomerInfo($cid);
		}else{
			if(checkRight('customer_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data['typeMsg'] = '新增';
		}
		$data['sexInfo'] = $this->config->item('sex');
		$data['languageInfo'] = $this->config->item('language');
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
		$customerList = $this->OA_Customer->queryCustomerByKey($key);	
		if(empty($customerList)){			
			$this->send_json(array('status'=>0));
		}else{
			$this->send_json(array('status'=>1,'customerList'=>$customerList));
		}
	}
}