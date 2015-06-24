<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 客户模型类
 * @author Administrator
 *
 */
class OA_Customer extends CI_Model
{
	private $_table = 'oa_customer';
	
	/**
	 * 初始化
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * 
	 * 获取客户
	 */
	public function getCustomer($offset, $limit)
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
	 * 获取客户数
	 */
	public function getCustomerCount()
	{
		return $this->db->count_all_results($this->_table);
	}
	
	/**
	 * 
	 * 通过条件获取用户数
	 */
	public function getCustomerCountByKey($query)
	{
		$this->db->where($query);
		return $this->db->count_all_results($this->_table);
	}
	
	/**
	 * 
	 * 通过id或名字查找客户
	 * @param unknown_type $key
	 */
	public function queryCustomerByKey($key)
	{
		$this->db->where('customer_id', $key);
		$this->db->or_where('customer_name', $key);
		$info = array();
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}
	
	/**
	 * 
	 * 获取客户信息
	 * @param unknown_type $user_id
	 */
	public function getCustomerInfo($customer_id)
	{
		$query = $this->db->get_where($this->_table, array('customer_id' => $customer_id));
		$info = array();
		if($query){
			$info = $query->row_array();
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
		
        $this->db->where('customer_id', $data['customer_id']);
		$this->db->update($this->_table, $data); 
	}
	
	/**
	 * 
	 * 删除
	 * @param unknown_type $customer_id
	 */
	public function del($customer_id)
	{
		$this->db->where('customer_id', $customer_id);
		$this->db->delete($this->_table); 
	} 
}