<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends OA_Controller 
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}
	
	/**
	 * 
	 * 系统用户首页
	 */
	public function index()
	{
		$data = array();
		if(checkRight('admin_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$this->load->model('OA_Department');
		$data['departmentTree'] = $this->OA_Department->getListTree(0);
		$adminList = array();
		if(isset($data['departmentTree'][0]['id'])){
			$pid = $data['departmentTree'][0]['id'];
			if($this->input->get('pid', TRUE)){
				$pid = $this->input->get('pid', TRUE);
			}
			$this->load->model('OA_Admin');
			$adminList = $this->OA_Admin->queryAdminByDepartment($pid);
			$data['pid'] = $pid;
		}
		$data['adminList'] = $adminList;
		$this->showView('adminList', $data);
	}
	
	/**
	 * 
	 * 增加/编辑用户
	 */
	public function add()
	{
		$data = array();
		$data['did'] = $this->input->get('did');
		$this->load->model('OA_Role');
		$data['roleList'] = $this->OA_Role->getAll();
		if($this->input->get('id')){
			if(checkRight('admin_edit') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$id = $this->input->get('id');
			$this->load->model('OA_Admin');
			$data['info'] = $this->OA_Admin->queryAdminByid($id);
			$data['typeMsg'] = '编辑';
		}else{
			if(checkRight('admin_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data['typeMsg'] = '新增';
		}
		$this->showView('adminAdd', $data);
	}
	
	/**
	 * 
	 * 增加/编辑逻辑
	 */
	public function doAdd()
	{
		$data = array();
		if($this->input->post('admin_id')){
			if(checkRight('admin_edit') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data = $this->input->post();
			if($data['admin_password']){
        		$data['admin_password'] = md5($admin_password);
        	}else{
        		unset($data['admin_password']);
        	}
			$this->load->model('OA_Admin');
			$this->OA_Admin->update($data);
			redirect(formatUrl('admin/index?pid='.$data['admin_department']));
		}else{
			if(checkRight('admin_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data = $this->input->post();
			$data['admin_password'] = md5($data['admin_password']);
			$data['reg_time'] = time();
			$this->load->model('OA_Admin');
			$msg = '';
			if($this->OA_Admin->add($data) === FALSE){
				$msg = '&msg='.urlencode('创建失败');
			}
			redirect(formatUrl('admin/index?pid='.$data['admin_department'].$msg));
		}
	}
	
	/**
	 * 
	 * 删除
	 */
	public function doDel()
	{
		$data = array();
		if(checkRight('admin_del') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$id = $this->input->get('id');
		$pid = $this->input->get('pid');
		$this->load->model('OA_Admin');
		$this->OA_Admin->del($id);
		redirect(formatUrl('admin/index?pid='.$pid));
	}
	
	/**
	 * 
	 * 修改密码
	 */
	public function changePassword()
	{
		$data = $this->input->post();
		$data['admin_password'] = md5($data['admin_password']);
		$this->load->model('OA_Admin');
		$data['info'] = $this->OA_Admin->update($data);
		$this->session->sess_destroy();
		redirect(formatUrl('login/index?msg='.urlencode('请使用新密码重新登录')));
	}
}