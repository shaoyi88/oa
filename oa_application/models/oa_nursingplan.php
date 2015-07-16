<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 护理计划模型类
 * @author Administrator
 *
 */
class OA_NursingPlan extends CI_Model
{
	private $_table = 'oa_nursing_plan';
	
	/**
	 * 初始化
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * 
	 * 获取护理计划
	 */
	public function getNursingPlan($offset, $limit)
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
	 * 获取护理计划总数
	 */
	public function getNursingPlanCount()
	{
		return $this->db->count_all_results($this->_table);
	}
	
	/**
	 * 
	 * 获取信息
	 * @param unknown_type $plan_id
	 */
	public function getInfo($plan_id)
	{
		$query = $this->db->get_where($this->_table, array('plan_id' => $plan_id));
		$info = array();
		if($query){
			$info = $query->row_array();
		}
		return $info;
	}
	
	/**
	 * 
	 * 通过订单id获取信息
	 * @param unknown_type $order_id
	 */
	public function getInfoByOrderId($order_id)
	{
		$query = $this->db->get_where($this->_table, array('order_id' => $order_id));
		$info = array();
		if($query){
			$info = $query->row_array();
		}
		return $info;
	}
	
	/**
	 * 
	 * 搜索护理计划
	 * @param unknown_type $keyword
	 */
	public function searchPlan($keyword)
	{
		$this->db->where('order_no', $keyword);
		$this->db->or_where('customer_name', $keyword);
		$this->db->or_where('worker_name', $keyword); 
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}
	
	/**
	 * 
	 * 增加
	 * @param unknown_type $data
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
	 * @param unknown_type $data
	 */
	public function update($data)
	{
        $this->db->where('plan_id', $data['plan_id']);
		$this->db->update($this->_table, $data); 
	}
	
	/**
	 * 
	 * 删除
	 * @param unknown_type $ids
	 */
	public function del($plan_id)
	{
		$this->db->where('plan_id', $plan_id);
		$this->db->delete($this->_table); 
	} 
}