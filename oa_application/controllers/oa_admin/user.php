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
		$data['areasInfo'] = $this->OA_Areas->getAreasNameList();	
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
			$user_id = $this->input->post('user_id');
			$user_phone = $this->input->post('user_phone');
			$user_sex = $this->input->post('user_sex');
			$user_province = $this->input->post('user_province');
			$user_city = $this->input->post('user_city');
			$this->load->model('OA_User');
			$this->OA_User->update($user_id, $user_phone, $user_sex, $user_province, $user_city);
			redirect(formatUrl('user/index'));
		}else{
			if(checkRight('user_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$user_phone = $this->input->post('user_phone');
			$user_sex = $this->input->post('user_sex');
			$user_province = $this->input->post('user_province');
			$user_city = $this->input->post('user_city');
			$msg = '';
			$this->load->model('OA_User');
			if($this->OA_User->add($user_phone, $user_sex, $user_province, $user_city) === FALSE){
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
		//删除地址信息
		//删除关注人信息
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
		$data['areasInfo'] = $this->OA_Areas->getAreasNameList();	
		$this->showView('userDetail', $data);
	}
}