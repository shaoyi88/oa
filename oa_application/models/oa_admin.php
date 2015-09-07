<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 管理员模型类
 * @author Administrator
 *
 */
class OA_Admin extends CI_Model
{
	private $_table = 'oa_admin';
	private $_roleTable = 'oa_role';
	
	/**
	 * 初始化
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * 
	 * 校验用户
	 * @param unknown_type $adminAccount
	 * @param unknown_type $adminPassword
	 */
	public function checkAdmin($adminAccount, $adminPassword)
	{
		$query = $this->db->get_where($this->_table, array('admin_account' => $adminAccount));
		if($query){
			$info = $query->row_array();
			if(!empty($info) && md5($adminPassword) == $info['admin_password']){
				return $info;
			}	
		}
		return FALSE;
	}
	
	/**
	 * 
	 * 增加
	 * @param unknown_type $admin_account
	 * @param unknown_type $admin_department
	 * @param unknown_type $admin_name
	 * @param unknown_type $admin_no
	 * @param unknown_type $admin_password
	 * @param unknown_type $admin_phone
	 * @param unknown_type $admin_role
	 */
	public function add($data)
	{
		$this->db->insert($this->_table, $data); 
		if($this->db->affected_rows() <= 0){
			return FALSE;
		}
		return TRUE;
	}
	
	/**
	 * 
	 * 更新
	 * @param unknown_type $admin_id
	 * @param unknown_type $admin_account
	 * @param unknown_type $admin_department
	 * @param unknown_type $admin_name
	 * @param unknown_type $admin_no
	 * @param unknown_type $admin_password
	 * @param unknown_type $admin_phone
	 * @param unknown_type $admin_role
	 */
	public function update($data)
	{
        $this->db->where('admin_id', $data['admin_id']);
		$this->db->update($this->_table, $data); 
	}
	
	/**
	 * 
	 * 删除
	 * @param unknown_type $ids
	 */
	public function del($id)
	{
		$this->db->where('admin_id', $id);
		$this->db->delete($this->_table); 
	} 
	
	/**
	 * 
	 * 通过id查找用户
	 * @param unknown_type $id
	 */
	public function queryAdminByid($id)
	{
		$this->db->where('admin_id', $id);
		$info = array();
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->row_array();
		}
		return $info;
	}
	
	/**
	 * 
	 * 通过部门查询用户
	 * @param unknown_type $dids
	 */
	public function queryAdminByDepartment($dids)
	{
		$this->db->where_in('admin_department', $dids);
		$info = array();
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}
	
	/**
	 * 通过角色查询用户
	 * Enter description here ...
	 * @param unknown_type $rid
	 */
	public function queryAdminByRole($rid)
	{
		$this->db->where('admin_role', $rid);
		$info = array();
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}
	
	/**
	 * 
	 * 通过手机查找
	 * @param unknown_type $phone
	 */
	public function queryAdminByPhone($phone)
	{
		$this->db->where('admin_phone', $phone);
		$info = array();
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}
	
	/**
	 * 查询可指派回访的用户
	 * Enter description here ...
	 */
	public function queryReturnAdmin()
	{
		$sql = "select * from `$this->_table` where admin_role in (select id from `$this->_roleTable` where role_rights like '%nursing_return_register%')";
		$query = $this->db->query($sql);
		$info = array();
		if($query){
			$info = $query->result_array();
		}
		return $info;
		
	}
}
