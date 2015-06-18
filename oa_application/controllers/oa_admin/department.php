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
		if(checkRight('department_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$this->load->model('OA_Department');
		$data['dataList'] = $this->OA_Department->getListTree(0);
		$this->showView('departmentList', $data);
	} 	
	
	/**
	 * 
	 * 新增
	 */
	public function doAdd()
	{
		$data = array();
		if(checkRight('department_add') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$data = $this->input->post();
		$data['pid'] = $data['pid'] ? $data['pid'] : 0;
		$this->load->model('OA_Department');
		$msg = '';
		if($this->OA_Department->add($data) === FALSE){
			$msg = '?msg='.urlencode('创建失败');
		}
		redirect(formatUrl('department/index'.$msg));
	}
	
	/**
	 * 
	 * 编辑
	 */
	public function doEdit()
	{
		$data = array();
		if(checkRight('department_edit') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$data = $this->input->post();
		$this->load->model('OA_Department');
		$this->OA_Department->update($data);
		redirect(formatUrl('department/index'));
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