<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 管理员模型类
 * @author Administrator
 *
 */
class Admin extends CI_Model
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
}
