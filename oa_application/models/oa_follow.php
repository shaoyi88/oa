<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 关注病人模型类
 * @author Administrator
 *
 */
class OA_Follow extends CI_Model
{
	private $_table = 'oa_follow';
	private $_infoTable = 'oa_customer';
	
	/**
	 * 初始化
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function add($user_id, $customer_id)
	{
		$info = $this->queryFollowByCid($user_id, $customer_id);
		if(empty($info)){
			$data = array(
            	'user_id' => $user_id,
            	'customer_id' => $customer_id
       	 	);
       	 	$this->db->insert($this->_table, $data); 
       	 	if($this->db->affected_rows() <= 0){
				return FALSE;
			}
			return TRUE;
		}
	}
	
	/**
	 * 
	 * 通过customer_id查找关注病人
	 * @param unknown_type $cid
	 */
	public function queryFollowByCid($uid, $cid)
	{
		$this->db->where('user_id', $uid);
		$this->db->where('customer_id', $cid);
		$info = array();
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->row_array();
		}
		return $info;
	}
	
	/**
	 * 
	 * 通过id查找关注病人
	 * @param unknown_type $id
	 */
	public function queryFollowByUid($uid)
	{
		$query = $this->db->query("select * from $this->_table as a left join $this->_infoTable as b on a.customer_id = b.customer_id where a.user_id=".$uid);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}
	
	/**
	 * 
	 * 删除
	 * @param unknown_type $ids
	 */
	public function del($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->_table); 
	} 
}