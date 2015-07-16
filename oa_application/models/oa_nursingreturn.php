<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 回访计划模型类
 * @author Administrator
 *
 */
class OA_NursingReturn extends CI_Model
{
	private $_table = 'oa_nursing_return';
	
	/**
	 * 初始化
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * 
	 * 获取回访计划
	 */
	public function getNursingReturn($executive_admin_id, $offset, $limit)
	{
		$info = array();
		if($executive_admin_id != ''){
			$this->db->where('executive_admin_id', $executive_admin_id);
		}
		$query = $this->db->get($this->_table, $limit, $offset);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}
	
	/**
	 * 
	 * 获取回访计划总数
	 */
	public function getNursingReturnCount($executive_admin_id)
	{
		if($executive_admin_id != ''){
			$this->db->where('executive_admin_id', $executive_admin_id);
		}
		return $this->db->count_all_results($this->_table);
	}
	
	/**
	 * 
	 * 搜索回访
	 * @param unknown_type $keyword
	 */
	public function searchNursingReturn($keyword, $executive_admin_id)
	{
		$this->db->where('customer_name', $keyword);
		if($executive_admin_id != ''){
			$this->db->where('executive_admin_id', $executive_admin_id);
		}
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
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
        $this->db->where('return_id', $data['return_id']);
		$this->db->update($this->_table, $data); 
	}
	
	/**
	 * 
	 * 删除
	 * @param unknown_type $return_id
	 */
	public function del($return_id)
	{
		$this->db->where('return_id', $return_id);
		$this->db->delete($this->_table); 
	} 
	
	/**
	 * 
	 * 根据计划id删除
	 * @param unknown_type $plan_id
	 */
	public function delByPlanId($plan_id)
	{
		$this->db->where('plan_id', $plan_id);
		$this->db->delete($this->_table); 
	} 
	
	/**
	 * 
	 * 获取信息
	 * @param unknown_type $return_id
	 */
	public function getInfo($return_id)
	{
		$query = $this->db->get_where($this->_table, array('return_id' => $return_id));
		$info = array();
		if($query){
			$info = $query->row_array();
		}
		return $info;
	}
	
}