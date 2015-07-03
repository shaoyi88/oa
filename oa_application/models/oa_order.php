<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 订单模型类
 * @author Administrator
 *
 */
class OA_Order extends CI_Model
{
	private $_table = 'oa_order';
	
	/**
	 * 初始化
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * 
	 * 获取订单
	 */
	public function getOrder($offset, $limit)
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
	 * 获取订单总数
	 */
	public function getOrderCount()
	{
		return $this->db->count_all_results($this->_table);
	}
	
	/**
	 * 
	 * 增加
	 * @param unknown_type $user_phone
	 * @param unknown_type $user_sex
	 * @param unknown_type $user_province
	 * @param unknown_type $user_city
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
	 * 获取订单信息
	 * @param unknown_type $order_id
	 */
	public function getOrderInfo($order_id)
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
	 * 更新订单
	 * @param unknown_type $data
	 */
	public function update($data)
	{
		
        $this->db->where('order_id', $data['order_id']);
		$this->db->update($this->_table, $data); 
	}
	
	/**
	 * 
	 * 删除
	 * @param unknown_type $ids
	 */
	public function del($order_id)
	{
		$this->db->where('order_id', $order_id);
		$this->db->delete($this->_table); 
	} 
}