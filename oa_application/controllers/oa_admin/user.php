<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends OA_Controller 
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}
	
	/**
	 * 
	 * 用户首页
	 */
	public function index()
	{
		$data = array();
		if(checkRight('user_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$this->load->model('OA_User');
		if($this->input->post('keyword')){
			$dataList = $this->OA_User->searchUser($this->input->post('keyword'));
		}else{
			$offset = 0;
			$pageUrl = '';
			page(formatUrl('user/index').'?', $this->OA_User->getUserCount(), PER_COUNT, $offset, $pageUrl);
			$dataList = $this->OA_User->getUser($offset, PER_COUNT);
			$data['pageUrl'] = $pageUrl;
		}
		$this->load->model('OA_Areas');
		$ids = array();
		foreach($dataList as $item){
			$ids[] = $item['user_province'];
			$ids[] = $item['user_city'];
		}
		if(!empty($ids)){
			$data['areasInfo'] = $this->OA_Areas->getAreasNameListByIds($ids);	
		}
		$data['dataList'] = $dataList;		
		$data['sexInfo'] = $this->config->item('sex');
		$this->showView('userList', $data);
	}
	
	/**
	 * 
	 * 增加/编辑用户页面
	 */
	public function add()
	{
		$data = array();
		$this->load->model('OA_Areas');
		$provinceInfo = $cityInfo = array();
		$provinceInfo = $this->OA_Areas->queryAreasByPid(0);		
		if($this->input->get('uid')){
			if(checkRight('user_edit') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$uid = $this->input->get('uid');
			$data['typeMsg'] = '编辑';
			$this->load->model('OA_User');
			$data['info'] = $this->OA_User->getUserInfo($uid);
			if($data['info']['user_province']){
				$cityInfo = $this->OA_Areas->queryAreasByPid($data['info']['user_province']);	
			}
		}else{
			if(checkRight('user_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data['typeMsg'] = '新增';
		}
		$data['provinceInfo'] = $provinceInfo;
		$data['cityInfo'] = $cityInfo;
		$data['sexInfo'] = $this->config->item('sex');
		$this->showView('userAdd', $data);
	}
	
	/**
	 * 
	 * 增加/编辑逻辑
	 */
	public function doAdd()
	{
		$data = array();
		if($this->input->post('user_id')){
			if(checkRight('user_edit') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data = $this->input->post();
			$this->load->model('OA_User');
			$this->OA_User->update($data);
			redirect(formatUrl('user/index'));
		}else{
			if(checkRight('user_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data = $this->input->post();
			$msg = '';
			$this->load->model('OA_User');
			if($this->OA_User->add($data) === FALSE){
				$msg = '?msg='.urlencode('创建失败');
			}
			redirect(formatUrl('user/index'.$msg));
		}
	}
	
	/**
	 * 
	 * 删除
	 */
	public function doDel()
	{
		$data = array();
		if(checkRight('user_del') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$uid = $this->input->get('uid');
		//删除用户信息
		$this->load->model('OA_User');
		$this->OA_User->del($uid);
		//删除红包信息
		$this->load->model('OA_Coupon');
		$this->OA_Coupon->delByUid($uid);
		//删除地址信息
		$this->load->model('OA_Address');
		$this->OA_Address->delByUid($uid);
		//删除关注人信息
		$this->load->model('OA_Follow');
		$this->OA_Follow->delByUid($uid);
		redirect(formatUrl('user/index'));
	}
	
	/**
	 * 
	 * 详情页面
	 */
	public function detail()
	{
		$data = array();
		if(checkRight('user_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$uid = $this->input->get('uid');
		$data['uid'] = $uid;
		$this->load->model('OA_User');
		$data['userInfo'] = $this->OA_User->getUserInfo($uid);
		$data['sexInfo'] = $this->config->item('sex');
		$this->load->model('OA_Address');
		$data['addressInfo'] = $this->OA_Address->queryAddressByUid($uid);
		$this->load->model('OA_Coupon');
		$data['couponInfo'] = $this->OA_Coupon->queryCouponByUid($uid);
		$this->load->model('OA_Follow');
		$data['followInfo'] = $this->OA_Follow->queryFollowByUid($uid);
		$this->load->model('OA_Areas');
		$data['provinceInfo'] = $this->OA_Areas->queryAreasByPid(0);	
		$ids = array();
		$ids[] = $data['userInfo']['user_province'];
		$ids[] = $data['userInfo']['user_city'];
		foreach($data['addressInfo'] as $item){
			$ids[] = $item['province'];
			$ids[] = $item['city'];
			$ids[] = $item['area'];
		}
		$data['areasInfo'] = $this->OA_Areas->getAreasNameListByIds($ids);	
		$this->showView('userDetail', $data);
	}
	
	/**
	 * 
	 * 获取用户
	 */
	public function getUser()
	{
		if($this->input->get('key')){
			$key = $this->input->get('key');
		}
		$this->load->model('OA_User');
		$userList = $this->OA_User->searchUser($key);	
		if(empty($userList)){			
			$this->send_json(array('status'=>0));
		}else{
			$this->send_json(array('status'=>1,'userList'=>$userList));
		}
	}
	
}