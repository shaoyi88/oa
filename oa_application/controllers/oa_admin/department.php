<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department extends OA_Controller 
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}
	
	/**
	 * 
	 * 组织部门主页
	 */
	public function index()
	{
		$data = array();
		$this->load->model('OA_Department');
		$data['dataList'] = $this->OA_Department->getListTree(0);
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$this->load->model('OA_Hospital');
		$data['hospital'] = $this->OA_Hospital->getNameList();
		$this->showView('departmentList', $data);
	} 	
	
	/**
	 * 
	 * 增加
	 */
	public function add()
	{
		$data = array();
		if($this->input->get('did')){
			if(checkRight('department_edit') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$did = $this->input->get('did');
			$this->load->model('OA_Department');
			$data['info'] = $this->OA_Department->getInfoById($did);
			$data['typeMsg'] = '编辑';
		}else{
			if(checkRight('department_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data['typeMsg'] = '新增';
		}
		$this->load->model('OA_Department');
		$data['dataList'] = $this->OA_Department->getListTree(0);
		$this->load->model('OA_Hospital');
		$data['hospitalList'] = $this->OA_Hospital->queryByPid(0);
		$this->showView('departmentAdd', $data);
	}
	
	/**
	 * 
	 * 新增
	 */
	public function doAdd()
	{
		$data = array();
		if($this->input->post('id')){
			if(checkRight('department_edit') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data = $this->input->post();
			$data['pid'] = $data['pid'] ? $data['pid'] : 0;
			$data['hospital_id'] = $data['hospital_id'] ? $data['hospital_id'] : 0;
			$this->load->model('OA_Department');
			$msg = '';
			$info = $this->OA_Department->getInfo($data['pid'], $data['department_name']);
			if(!empty($info) && $info['id'] != $data['id']){
				$msg = '?msg='.urlencode('该部门下已存在同名子部门');
			}else{
				$this->OA_Department->update($data);
			}
		}else{
			if(checkRight('department_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data = $this->input->post();
			$data['pid'] = $data['pid'] ? $data['pid'] : 0;
			$this->load->model('OA_Department');
			$msg = '';
			$info = $this->OA_Department->getInfo($data['pid'], $data['department_name']);
			if(!empty($info)){
				$msg = '?msg='.urlencode('该部门下已存在同名子部门');
			}else{
				if($this->OA_Department->add($data) === FALSE){
					$msg = '?msg='.urlencode('创建失败');
				}
			}
		}
		redirect(formatUrl('department/index'.$msg));
	}
	
	/**
	 * 
	 * 删除
	 */
	public function doDel()
	{
		$data = array();
		if(checkRight('department_del') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$id = $this->input->get('did');
		$this->load->model('OA_Department');
		$subList = $this->OA_Department->getListTree($id);
		$idList = array();
		$idList[] = $id;
		foreach($subList as $item){
			$idList[] = $item['id'];
		}
		$this->load->model('OA_Admin');
		$adminList = $this->OA_Admin->queryAdminByDepartment($idList);
		if(empty($adminList)){
			$this->OA_Department->del($idList);
			redirect(formatUrl('department/index'));
		}else{
			redirect(formatUrl('department/index?msg='.urlencode('该组织部门下存在'.count($adminList).'个用户，暂时不可删除')));
		}
	}
}