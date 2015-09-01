<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * 咨客模型类
 * @author Administrator
 *
 */
class OA_Customerservice extends CI_Model
{
	private $_table = 'oa_customerservice';
	private $_order = 'oa_order';

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
	 * 获取客服问题
	 */
	public function getCs($offset, $limit)
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
	 * 获取客服问题数
	 */
	public function getCsCount()
	{
		return $this->db->count_all_results($this->_table);
	}

	/**
	 *
	 * 搜索客服问题
	 * @param unknown_type $keyword
	 */
	public function searchCs($keyword=array())
	{
		if(isset($keyword['cs_type'])&&$keyword['cs_type']){
		    $this->db->where('cs_type', $keyword['cs_type']);
		}
		if(isset($keyword['appointed'])&&$keyword['appointed']){
			$this->db->where('appointed', $keyword['appointed']);
		}
		if(isset($keyword['cs_status'])&&$keyword['cs_status']){
		    $this->db->where('cs_status', $keyword['cs_status']);
		}
		if((isset($keyword['sdate'])&&$keyword['sdate'])&&(isset($keyword['edate'])&&$keyword['edate'])){
			$sdate = strtotime($keyword['sdate']);
			$edate = strtotime($keyword['edate'])+86400;
		    $this->db->where('added_time between '.$sdate.' and '.$edate.'');
		}
		if(isset($keyword['keyword'])&&$keyword['keyword']){
		    $this->db->where('cs_user_phone', $keyword['keyword']);
		    $this->db->or_where('cs_no', $keyword['keyword']);
		}
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}

	/**
	 *
	 * 记录问题

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
	 * 编辑和处理
	 */
	public function update($data)
	{

        $this->db->where('id', $data['id']);
		$this->db->update($this->_table, $data);
	}

	/**
	 *
	 * 获取问题信息
	 * @param unknown_type $id
	 */
	public function getCsInfo($id)
	{
		$query = $this->db->get_where($this->_table, array('id' => $id));
		$info = array();
		if($query){
			$info = $query->row_array();
		}
		if($info['cs_user_order']){
			$sql = "select * from `oa_order` as o left join `oa_customer` as c on o.customer_id = c.customer_id where order_id=".$info['cs_user_order'];
			$orderquery = $this->db->query($sql);
			$info['orderinfo'] = $orderquery->row_array();
		}
		return $info;
	}

	/**
	 *
	 * 删除
	 */
	public function del($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->_table);
	}

}