<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 用户模型类
 * @author Administrator
 *
 */
class OA_User extends CI_Model
{
	private $_table = 'oa_user';
	
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
	 * 获取用户
	 */
	public function getUser($offset, $limit)
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
	 * 获取用户数
	 */
	public function getUserCount()
	{
		return $this->db->count_all_results($this->_table);
	}
}