<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 红包模型类
 * @author Administrator
 *
 */
class OA_Coupon extends CI_Model
{
	private $_table = 'oa_coupon';
	
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
	 * 通过id查找红包
	 * @param unknown_type $id
	 */
	public function queryCouponByUid($uid)
	{
		$this->db->where('user_id', $uid);
		$info = array();
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}
	
	/**
	 * 
	 * 增加红包
	 * @param unknown_type $user_id
	 * @param unknown_type $coupon_amount
	 * @param unknown_type $coupon_condition
	 * @param unknown_type $coupon_expire
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
	 * 删除
	 * @param unknown_type $ids
	 */
	public function del($id)
	{
		$this->db->where('coupon_id', $id);
		$this->db->delete($this->_table); 
	} 
	
	/**
	 * 
	 * 通过uid删除
	 * @param unknown_type $uid
	 */
	public function delByUid($uid)
	{
		$this->db->where('user_id', $uid);
		$this->db->delete($this->_table); 
	} 
}