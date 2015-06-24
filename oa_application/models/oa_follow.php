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
	private $_customerInfoTable = 'oa_customer';
	private $_userInfoTable = 'oa_user';
	
	/**
	 * 初始化
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	public function add($data)
	{
		$info = $this->queryFollowByUidCid($data['user_id'], $data['customer_id']);
		if(empty($info)){
       	 	$this->db->insert($this->_table, $data); 
       	 	if($this->db->affected_rows() <= 0){
				return FALSE;
			}
			return TRUE;
		}
	}
	
	/**
	 * 
	 * 通过uid和customer_id查找关注病人
	 * @param unknown_type $cid
	 */
	public function queryFollowByUidCid($uid, $cid)
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
	 * 通过customer_id查找关注用户
	 * @param unknown_type $cid
	 */
	public function queryFollowByCid($cid)
	{
		$query = $this->db->query("select * from $this->_table as a left join $this->_userInfoTable as b on a.user_id = b.user_id where a.customer_id=".$cid);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}
	
	/**
	 * 
	 * 通过uid查找关注病人
	 * @param unknown_type $id
	 */
	public function queryFollowByUid($uid)
	{
		$query = $this->db->query("select * from $this->_table as a left join $this->_customerInfoTable as b on a.customer_id = b.customer_id where a.user_id=".$uid);
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
	
	/**
	 * 
	 * 通过uid删除
	 * @param unknown_type $id
	 */
	public function delByUid($uid)
	{
		$this->db->where('user_id', $uid);
		$this->db->delete($this->_table); 
	} 
	
	/**
	 * 
	 * 通过客户id删除
	 * @param unknown_type $cid
	 */
	public function delByCid($cid)
	{
		$this->db->where('customer_id', $cid);
		$this->db->delete($this->_table); 
	} 
}