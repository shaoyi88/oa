<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * 医院意见建议模型类
 * @author Administrator
 *
 */
class OA_Hospitaladvice extends CI_Model
{
	private $_table = 'oa_hospitaladvice';

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
	 * 获取意见建议
	 */
	public function getHp($offset, $limit)
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
	 * 获取意见建议数
	 */
	public function getHpCount()
	{
		return $this->db->count_all_results($this->_table);
	}

	/**
	 *
	 * 搜索意见建议
	 * @param unknown_type $keyword
	 */
	public function searchHp($keyword=array())
	{
		if(isset($keyword['appointed'])&&$keyword['appointed']){
			$this->db->where('appointed', $keyword['appointed']);
		}
		if(isset($keyword['advice_status'])&&$keyword['advice_status']){
		    $this->db->where('advice_status', $keyword['advice_status']);
		}
		if(isset($keyword['keyword'])&&$keyword['keyword']){
		    $this->db->where('added_by', $keyword['keyword']);
		}
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}

	/**
	 *
	 * 记录意见建议

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
	 * 编辑和反馈跟进
	 */
	public function update($data)
	{

        $this->db->where('advice_id', $data['advice_id']);
		$this->db->update($this->_table, $data);
	}

	/**
	 *
	 * 获取意见建议信息
	 * @param unknown_type $id
	 */
	public function getHpInfo($id)
	{
		$query = $this->db->get_where($this->_table, array('advice_id' => $id));
		$info = array();
		if($query){
			$info = $query->row_array();
		}
		return $info;
	}

	/**
	 *
	 * 删除
	 */
	public function del($id)
	{
		$this->db->where('advice_id', $id);
		$this->db->delete($this->_table);
	}

}