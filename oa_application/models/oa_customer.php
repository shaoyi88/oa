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
		$this->load->database();
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
}
