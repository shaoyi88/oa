<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 订单历史模型类
 * @author Administrator
 *
 */
class OA_OrderHistory extends CI_Model
{
	private $_table = 'oa_order_history';
	
	/**
	 * 初始化
	 */
	public function __construct()
	{
		parent::__construct();
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
	 * 通过order_id查找历史记录
	 * @param unknown_type $order_id
	 */
	public function queryHistoryByOrderId($order_id)
	{
		$this->db->where('order_id', $order_id);
		$info = array();
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}
}