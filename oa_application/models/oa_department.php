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
	}

	/**
	 *
	 * 增加部门
	 * @param unknown_type $pid
	 * @param unknown_type $departmentName
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
	 * 获取信息
	 * @param unknown_type $pid
	 * @param unknown_type $department_name
	 */
	public function getInfo($pid, $department_name)
	{
		$this->db->where('pid', $pid);
		$this->db->where('department_name', $department_name);
		$query = $this->db->get($this->_table);
		$info = array();
		if($query){
			$info = $query->row_array();
		}
		return $info;
	}
	
	/**
	 * 
	 * 通过部门id获取信息
	 * @param unknown_type $did
	 */
	public function getInfoById($did)
	{
		$this->db->where('id', $did);
		$query = $this->db->get($this->_table);
		$info = array();
		if($query){
			$info = $query->row_array();
		}
		return $info;
	}

	/**
	 *
	 * 更新
	 * @param unknown_type $id
	 * @param unknown_type $name
	 */
	public function update($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update($this->_table, $data);
	}

	/**
	 *
	 * 删除
	 * @param unknown_type $ids
	 */
	public function del($dids)
	{
		$this->db->where_in('id', $dids);
		$this->db->delete($this->_table);
	}

	/**
	 *
	 * 获取树
	 * @param unknown_type $pid
	 */
	public function getListTree($pid, $allList = NULL)
	{
		if($allList === NULL){
			$allList = $this->_getAll();
		}
		$reuslt = array();
		$this->_getSubList($reuslt, $allList, $pid, 0);
		return $reuslt;
	}

	/**
	 *
	 * 获取子树
	 * @param unknown_type $result
	 * @param unknown_type $allList
	 * @param unknown_type $pid
	 * @param unknown_type $level
	 */
	private function _getSubList(&$result, $allList, $pid, $level)
	{
		foreach($allList as $item){
			if($item['pid'] == $pid){
				$item['level'] = $level;
				$result[] = $item;
				$this->_getSubList($result,$allList,$item['id'],$level+1);
			}
		}
	}

	/**
	 *
	 * 获取全部部门数据
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

	/**
	 * 获取部门名
	 */
	public function getDepartmentName(){
		$allList = $this->_getAll();
		$info = array();
		foreach($allList as $v){
			$info[$v['id']] = $v['department_name'];
		}
		return $info;
	}
}
