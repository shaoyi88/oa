<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 地址模型类
 * @author Administrator
 *
 */
class OA_Address extends CI_Model
{
	private $_table = 'oa_address';
	
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
	 * 通过id查找地址
	 * @param unknown_type $id
	 */
	public function queryAddressByUid($uid)
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
	 * 增加
	 * @param unknown_type $user_id
	 * @param unknown_type $province
	 * @param unknown_type $city
	 * @param unknown_type $area
	 * @param unknown_type $is_default
	 */
	public function add($data)
	{
        if($data['is_default'] == 1){
        	//去掉其他地址的默认
        	$this->db->where('user_id', $data['user_id']);
        	$this->db->update($this->_table, array('is_default' => 0)); 
        }
		$this->db->insert($this->_table, $data); 
		if($this->db->affected_rows() <= 0){
			return FALSE;
		}
		return TRUE;
	}
	
	/**
	 * 
	 * 设置默认地址
	 * @param unknown_type $id
	 */
	public function setAddressIsDefault($user_id, $id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('address_id !=', $id);
        $this->db->update($this->_table, array('is_default' => 0)); 
        $this->db->where('user_id', $user_id);
		$this->db->where('address_id', $id);
        $this->db->update($this->_table, array('is_default' => 1)); 
	}
	
	/**
	 * 
	 * 删除
	 * @param unknown_type $ids
	 */
	public function del($id)
	{
		$this->db->where('address_id', $id);
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