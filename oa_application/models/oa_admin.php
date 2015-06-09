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
	
	/**
	 * 初始化
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
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
	public function add($admin_account, $admin_department, $admin_name, $admin_no, $admin_password, $admin_phone, $admin_role)
	{
		$data = array(
            'admin_account' => $admin_account,
            'admin_department' => $admin_department,
			'admin_name' => $admin_name,
			'admin_no' => $admin_no,
			'admin_password' => md5($admin_password),
			'admin_phone' => $admin_phone,
			'admin_role' => $admin_role,
			'admin_department' => $admin_department,
			'admin_department' => $admin_department,
			'reg_time' => time()
        );
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
	public function update($admin_id, $admin_account, $admin_department, $admin_name, $admin_no, $admin_password, $admin_phone, $admin_role)
	{
		$data = array(
            'admin_department' => $admin_department,
			'admin_name' => $admin_name,
			'admin_no' => $admin_no,
			'admin_phone' => $admin_phone,
			'admin_role' => $admin_role,
			'admin_department' => $admin_department,
			'admin_department' => $admin_department,
			'reg_time' => time()
        );
        if($admin_password){
        	$data['admin_password'] = md5($admin_password);
        }
        $this->db->where('admin_id', $admin_id);
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
}
