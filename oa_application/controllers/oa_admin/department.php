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
		if(checkRight('department_list') === FALSE){
			echo '没有权限';
			exit;
		}
		$data = array();
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$this->load->model('OA_Department');
		$allList = $this->OA_Department->getAll();
		$dataList = array();
		$this->_formatList($dataList, $allList, 0, 0);
		$data['dataList'] = $dataList;
		$this->showView('departmentList', $data);
	} 	
	
	/**
	 * 
	 * 格式化树
	 * @param unknown_type $result
	 * @param unknown_type $allList
	 * @param unknown_type $pid
	 * @param unknown_type $level
	 */
	private function _formatList(&$result, $allList, $pid, $level)
	{
		foreach($allList as $item){
			if($item['pid'] == $pid){
				$item['level'] = $level;
				$result[] = $item;
				$this->_formatList($result,$allList,$item['id'],$level+1);
			}
		}
	}
	
	/**
	 * 
	 * 新增
	 */
	public function doAdd()
	{
		if(checkRight('department_add') === FALSE){
			echo '没有权限';
			exit;
		}
		$pid = 0;
		if($this->input->post('pid')){
			$pid = $this->input->post('pid');
		}
		if(($department_name = $this->input->post('department_name')) === FALSE){
			redirect(formatUrl('department/index?msg='.urlencode('组织部门名称不可为空')));
		}
		$this->load->model('OA_Department');
		$msg = '创建成功';
		if($this->OA_Department->add($pid, $department_name) === FALSE){
			$msg = '创建失败';
		}
		redirect(formatUrl('department/index?msg='.urlencode($msg)));
	}
	
	/**
	 * 
	 * 编辑
	 */
	public function doEdit()
	{
		if(checkRight('department_edit') === FALSE){
			echo '没有权限';
			exit;
		}
		$id = $this->input->post('did');
		$department_name = $this->input->post('department_name');
		$this->load->model('OA_Department');
		$this->OA_Department->update($id, $department_name);
		redirect(formatUrl('department/index?msg='.urlencode('修改成功')));
	}
}