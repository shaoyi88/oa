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

	/**
	 *
	 * 获取医院
	*/
	public function getHospital($offset, $limit)
	{
		$info = array();
		$this->db->where('parent_id', 0);
		$this->db->order_by("wb_id","asc");
		$query = $this->db->get($this->_table, $limit, $offset);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}
	/**
	 *
	 * 获取医院数
	 */
	public function getHospitalCount()
	{
		$this->db->where('parent_id', 0);
		return $this->db->count_all_results($this->_table);
	}

	/**
	 *
	 * 搜索医院
	 * @param unknown_type $keyword
	 */
	public function searchHospital($keyword)
	{
		$this->db->where('stationary_name', $keyword);
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}

	/**
	 *
	 * 增加
	 */
	public function add($data)
	{
		$this->db->insert($this->_table, $data);
		if($this->db->affected_rows() <= 0){
			return FALSE;
		}
		return $this->db->insert_id();
	}

    /**
	 *
	 * 获取医院信息
	 */
    public function getHospitalInfo($wb_id)
	{
		$query = $this->db->get_where($this->_table, array('wb_id' => $wb_id));
		$info = array();
		if($query){
			$info = $query->row_array();
		}
		return $info;
	}

	/**
	 *
	 * 编辑
	 */
	public function update($data)
	{

        $this->db->where('wb_id', $data['wb_id']);
		$this->db->update($this->_table, $data);
	}


	/**
	 *
	 * 删除医院
	 *
	 */
	public function del($wb_id)
	{
		$this->db->where('wb_id', $wb_id);
		$this->db->or_where('parent_id', $wb_id);
		$this->db->delete($this->_table);
	}

	/**
	 *
	 * 删除科室
	 *
	 */
	public function delsta($staid,$wb_id)
	{

		$this->db->where('parent_id', $wb_id);
		if(!empty($staid)){
		  $this->db->where_not_in('wb_id', $staid);
		}
		$this->db->delete($this->_table);
	}

	/**
	 *
	 * 获取树
	 * @param unknown_type $parent_id
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
	 * @param unknown_type $parent_id
	 * @param unknown_type $level
	 */
	private function _getSubList(&$result, $allList, $pid, $level)
	{
		foreach($allList as $item){
			if($item['parent_id'] == $pid){
				$item['level'] = $level;
				$result[] = $item;
				$this->_getSubList($result,$allList,$item['wb_id'],$level+1);
			}
		}
	}
}