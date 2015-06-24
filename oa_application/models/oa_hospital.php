<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 *	医院模型类
 * @author Administrator
 *
 */
class OA_Hospital extends CI_Model
{
	private $_table = 'oa_hospital';
	
	/**
	 * 初始化
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * 
	 * 查询子科目
	 * @param unknown_type $pid
	 */
	public function queryByPid($pid)
	{
		$this->db->where('parent_id', $pid);
		$info = array();
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}
	
	/**
	 * 
	 * 获取医院部门名列表
	 */
	public function getNameList()
	{
		$allList = $this->_getAll();
		$result = array();
		foreach($allList as $item){
			$result[$item['wb_id']] = $item['stationary_name'];
		}
		return $result;
	}
	
	/**
	 * 
	 * 获取全部
	 */
	private function _getAll()
	{
		$info = array();
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}
}