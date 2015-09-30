<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 用户模型类(正式数据库)
 * @author Administrator
 *
 */
class Oa_User_Yijianyi
{
	private $_table = 'oa_user';
	public $db;
	/**
	 * 初始化
	 */
	public function __construct()
	{
		$conf['hostname']	= 'yijianyi.mysql.rds.aliyuncs.com';
		$conf['username']	= 'yijianyi';
		$conf['password'] 	= 'yijianyi2015';
		$conf['database'] 	= 'yijianyi';
		$conf['dbdriver'] 	= 'mysql';
		$conf['dbprefix'] 	= '';
		$conf['pconnect'] 	= FALSE;
		$conf['db_debug'] 	= FALSE;
		$conf['cache_on'] 	= FALSE;
		$conf['cachedir'] 	= '';
		$conf['char_set'] 	= 'utf8';
		$conf['dbcollat'] 	= 'utf8_general_ci';
		$conf['swap_pre'] 	= '';
		$conf['stricton'] 	= FALSE;
		$Ci_controller		= &get_instance();
		$this->db			= $Ci_controller->load->database($conf,true);
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
		return $this->db->insert_id();
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
	public function update($data)
	{
		
        $this->db->where('user_id', $data['user_id']);
		$this->db->update($this->_table, $data); 
	}
	
	
	/**
	 * 
	 * 查询
	 * @param str openid
	 */	
	public function selForwxid($openid){
		$query = $this->db->get_where($this->_table, array('user_weixin' => $openid));
		$info = array();
		if($query){
			$info = $query->row_array();
		}
			
		return $info;
	}
	
	/**
	 * 
	 * 修改
	 * @param arr (openid,status)
	 */	
	public function updateforopenid($data)
	{
		$this->db->where('user_weixin', $data['user_weixin']);
		$this->db->update($this->_table, array('focus_status'=>$data['focus_status'])); 
	}
}