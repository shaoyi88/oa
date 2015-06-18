<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role extends OA_Controller 
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}
	
	/**
	 * 
	 * 权限主页
	 */
	public function index()
	{
		$data = array();
		if(checkRight('role_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$this->load->model('OA_Role');
		$data['dataList'] = $this->OA_Role->getAll();
		$this->showView('roleList', $data);
	} 	
	
	/**
	 * 
	 * 增加/编辑权限
	 */
	public function add()
	{
		$data = array();
		$data['roleList'] = $this->config->item('rights');
		if($this->input->get('id')){
			if(checkRight('role_edit') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$id = $this->input->get('id');
			$this->load->model('OA_Role');
			$data['info'] = $this->OA_Role->getRoleInfo($id);
			$data['roles'] = explode(',', $data['info']['role_rights']);
			$data['typeMsg'] = '编辑';
		}else{
			if(checkRight('role_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data['typeMsg'] = '新增';
		}
		$this->showView('roleAdd', $data);
	}
	
	/**
	 * 
	 * 增加/编辑逻辑
	 */
	public function doAdd()
	{
		$data = array();
		if($this->input->post('id')){
			if(checkRight('role_edit') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data = $this->input->post();
			$data['role_rights'] = $this->_formatRoles($data['role_rights']);
			$this->load->model('OA_Role');
			$this->OA_Role->update($data);
			redirect(formatUrl('role/index'));
		}else{
			if(checkRight('role_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data = $this->input->post();
			$data['role_rights'] = $this->_formatRoles($data['role_rights']);
			$this->load->model('OA_Role');
			$msg = '';
			if($this->OA_Role->add($data) === FALSE){
				$msg = '?msg='.urlencode('创建失败');
			}
			redirect(formatUrl('role/index'.$msg));
		}
	}
	
	/**
	 * 
	 * 删除
	 */
	public function doDel()
	{
		$data = array();
		if(checkRight('role_del') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$id = $this->input->get('id');
		$this->load->model('OA_Admin');
		$adminList = $this->OA_Admin->queryAdminByRole($id);
		$this->load->model('OA_Role');
		if(empty($adminList)){
			$this->OA_Role->del($id);
			redirect(formatUrl('role/index'));
		}else{
			redirect(formatUrl('role/index?msg='.urlencode('该分组下存在'.count($adminList).'个用户，暂时不可删除')));
		}
	}
	
	/**
	 * 
	 * 格式化权限
	 * @param unknown_type $roles
	 */
	private function _formatRoles($roles)
	{
		$allRoles = $this->config->item('rights');
		$roleResult = $roles;
		foreach($allRoles as $item){
			foreach($item['roles'] as $role){
				if(in_array($role[1], $roles)){
					$roleResult[] = $item['right'];
					break;
				}
			}
		}
		return implode(',', $roleResult);
	}
}