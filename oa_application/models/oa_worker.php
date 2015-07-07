<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * 护工模型类
 * @author Administrator
 *
 */
class OA_Worker extends CI_Model
{
	private $_table = 'oa_worker';

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
	 * 获取护工
	 */
	public function getWorker($offset, $limit)
	{
		$info = array();
		$query = $this->db->get($this->_table, $limit, $offset);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}

	/**
	 *
	 * 获取护工数
	 */
	public function getWorkerCount()
	{
		return $this->db->count_all_results($this->_table);
	}

	/**
	 *
	 * 搜索护工
	 * @param unknown_type $keyword
	 */
	public function searchWorker($keyword)
	{
		$this->db->where('worker_no', $keyword);
		$this->db->or_where('worker_name', $keyword);
		$this->db->or_where('worker_phone', $keyword);
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}

	/**
	 *
	 * 增加
	 * @param unknown_type $worker_phone
	 * @param unknown_type $worker_sex
	 * @param unknown_type $worker_domicile_province
	 * @param unknown_type $worker_domicile_city
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
	 * 编辑
	 * @param unknown_type $worker_id
	 * @param unknown_type $worker_phone
	 * @param unknown_type $worker_sex
	 * @param unknown_type $worker_domicile_province
	 * @param unknown_type $worker_domicile_city
	 */
	public function update($data)
	{

        $this->db->where('worker_id', $data['worker_id']);
		$this->db->update($this->_table, $data);
	}

	/**
	 *
	 * 获取护工信息
	 * @param unknown_type $worker_id
	 */
	public function getWorkerInfo($worker_id)
	{
		$query = $this->db->get_where($this->_table, array('worker_id' => $worker_id));
		$info = array();
		if($query){
			$info = $query->row_array();
		}
		return $info;
	}

	/**
	 *
	 * 删除
	 * @param unknown_type $ids
	 */
	public function del($worker_id)
	{
		$this->db->where('worker_id', $worker_id);
		$this->db->delete($this->_table);
	}

	/**
	 *
	 * 通过医院科室查询护工
	 * @param unknown_type $hids
	 */
	public function queryworkerByHospital($hids)
	{
		$this->db->where_in('worker_stationary', $hids);
		$info = array();
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}

	/**
	 *
	 * 护工统计
	 * @param unknown_type $keyword
	 */
	public function statWorker($keydata)
	{
		if(isset($keydata['worker_hospital'])){
			$this->db->where('worker_hospital', $keydata['worker_hospital']);
		}
		if(isset($keydata['nid'])){
			$this->db->where('worker_stationary', $keydata['worker_stationary']);
		};
		$this->db->or_where('worker_name', $keyword);
		$this->db->or_where('worker_phone', $keyword);
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}
}