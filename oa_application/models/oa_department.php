<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 组织部门模型类
 * @author Administrator
 *
 */
class OA_Department extends CI_Model
{
	private $_table = 'oa_department';
	
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
	 * 增加部门
	 * @param unknown_type $pid
	 * @param unknown_type $departmentName
	 */
	public function add($pid, $departmentName)
	{
		$data = array(
            'pid' => $pid,
            'department_name' => $departmentName
        );
		$this->db->insert($this->_table, $data); 
		if($this->db->affected_rows() <= 0){
			return FALSE;
		}
		return TRUE;
	}
	
	/**
	 * 
	 * 获取部门数据
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
	
	/**
	 * 
	 * 更新
	 * @param unknown_type $id
	 * @param unknown_type $name
	 */
	public function update($id, $name)
	{
		$data = array(
            'department_name' => $name
        );
		$this->db->where('id', $id);
		$this->db->update($this->_table, $data); 
	}
}
