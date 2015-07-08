<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * 护工订单模型类
 * @author Administrator
 *
 */
class OA_WorkerOrder extends CI_Model
{
	private $_table = 'oa_worker_order';
	private $_workerTable = 'oa_worker';

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
	 * 批量插入
	 * @param unknown_type $data
	 */
	public function addBatch($data)
	{
		$this->db->insert_batch($this->_table, $data);
		if($this->db->affected_rows() <= 0){
			return FALSE;
		}
		return TRUE;
	}
	
	/**
	 * 
	 * 批量更新
	 * @param unknown_type $workerList
	 * @param unknown_type $data
	 */
	public function update($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update($this->_table, $data);
	}
	
	/**
	 * 
	 * 获取订单的护工
	 * @param unknown_type $oid
	 * @param unknown_type $showHistoryWorker 是否显示历史护工
	 */
	public function getOrderWorkers($oid, $showHistoryWorker = FALSE)
	{
		$sql = "select * from $this->_table as a left join $this->_workerTable as b on a.worker_id = b.worker_id where a.order_id=".$oid;
		if(!$showHistoryWorker){
			$sql .= ' and a.status=1';
		}
		$query = $this->db->query($sql);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}
	
	/**
	 * 
	 * 通过护工id获取订单
	 * @param unknown_type $workerIds
	 */
	public function getOrderByWorkerId($workerIds)
	{
		$this->db->where_in('worker_id', $workerIds);
		$this->db->where('status', 1);
		$info = array();
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}
}