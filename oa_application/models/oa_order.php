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
	 * 搜索订单
	 * @param unknown_type $keyword
	 */
	public function searchOrder($keyword)
	{
		$sql = "select * from `oa_order` as o left join `oa_customer` as c on o.customer_id = c.customer_id left join `oa_user` as u on o.user_id = u.user_id where ".
				"o.order_no = '".$keyword."'".
				" or c.customer_name = '".$keyword."'".
				" or u.user_name = '".$keyword."'";
		$query = $this->db->query($sql);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}
	
	/**
	 * 
	 * 通过客户名搜索订单(条件：进行中的订单，服务类型居家照护或医疗陪护，服务模式不为多对一)
	 * @param unknown_type $customerName
	 */
	public function searchOrderByCustomerName($customerName)
	{
		$sql = "select * from `oa_order` as o left join `oa_customer` as c on o.customer_id = c.customer_id where ".
				" c.customer_name = '".$customerName."' and (o.service_type = 1 or o.service_type = 2) and o.service_mode != 3 and order_status = 2";
		$query = $this->db->query($sql);
		if($query){
			$info = $query->row_array();
		}
		return $info;
	}
	
	/**
	 * 
	 * 获取订单
	 */
	public function getOrder($offset, $limit)
	{
		$info = array();
		$sql = "select * from `oa_order` as o left join `oa_customer` as c on o.customer_id = c.customer_id order by order_id desc limit $offset,$limit";
		$query = $this->db->query($sql);
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
	 * 获取客户id获取订单信息
	 * @param unknown_type $customer_id
	 */
	public function getOrderInfoByCustomerId($customer_id)
	{
		$this->db->where('customer_id', $customer_id);
		$this->db->where_in('order_status', array(1,2,3));
		$query = $this->db->get($this->_table);
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