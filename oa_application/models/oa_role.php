<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 权限模型类
 * @author Administrator
 *
 */
class OA_Role extends CI_Model
{
	private $_table = 'oa_role';
	
	/**
	 * 初始化
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	
	
	/**
	 * 获取权限
	 * Enter description here ...
	 */
	public function getRoleInfo($id)
	{
		$query = $this->db->get_where($this->_table, array('id' => $id));
		$info = array();
		if($query){
			$info = $query->row_array();
		}
		return $info;
	}
	
	/**
	 * 
	 * 获取全部数据
	 */
	public function getAll()
	{
		$info = array();
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}
}