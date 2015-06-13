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
	
	/**
	 * 
	 * 搜索用户
	 * @param unknown_type $keyword
	 */
	public function searchUser($keyword)
	{
		$this->db->where('user_weixin', $keyword);
		$this->db->or_where('user_nickname', $keyword); 
		$this->db->or_where('user_phone', $keyword); 
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}
	
	/**
	 * 
	 * 增加
	 * @param unknown_type $user_phone
	 * @param unknown_type $user_sex
	 * @param unknown_type $user_province
	 * @param unknown_type $user_city
	 */
	public function add($user_phone, $user_sex, $user_province, $user_city)
	{
		$data = array(
            'user_phone' => $user_phone,
            'user_sex' => $user_sex,
			'user_province' => $user_province,
			'user_city' => $user_city,
        );
		$this->db->insert($this->_table, $data); 
		if($this->db->affected_rows() <= 0){
			return FALSE;
		}
		return TRUE;
	}
	
	/**
	 * 
	 * 编辑
	 * @param unknown_type $user_id
	 * @param unknown_type $user_phone
	 * @param unknown_type $user_sex
	 * @param unknown_type $user_province
	 * @param unknown_type $user_city
	 */
	public function update($user_id, $user_phone, $user_sex, $user_province, $user_city)
	{
		$data = array(
            'user_phone' => $user_phone,
            'user_sex' => $user_sex,
			'user_province' => $user_province,
			'user_city' => $user_city,
        );
        $this->db->where('user_id', $user_id);
		$this->db->update($this->_table, $data); 
	}
	
	/**
	 * 
	 * 获取用户信息
	 * @param unknown_type $user_id
	 */
	public function getUserInfo($user_id)
	{
		$query = $this->db->get_where($this->_table, array('user_id' => $user_id));
		$info = array();
		if($query){
			$info = $query->row_array();
		}
		return $info;
	}
	
	/**
	 * 
	 * 删除
	 * @param unknown_type $ids
	 */
	public function del($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->delete($this->_table); 
	} 
}