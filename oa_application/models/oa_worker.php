<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * 护工模型类
 * @author Administrator
 *
 */
class OA_Worker extends CI_Model
{
	private $_table = 'oa_worker';

	/**
	 * 初始化
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('form','url'));
	}

	/**
	 *
	 * 获取护工
	 */
	public function getWorker($offset, $limit, $hospitalId = 0)
	{
		$info = array();
		$this->db->order_by('worker_id', 'DESC');
		if($hospitalId != 0){
			$this->db->where('worker_hospital', $hospitalId);
		}
		$query = $this->db->get($this->_table, $limit, $offset);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}

	/**
	 *
	 * 获取护工数
	 */
	public function getWorkerCount($hospitalId = 0)
	{
		if($hospitalId != 0){
			$this->db->where('worker_hospital', $hospitalId);
		}
		return $this->db->count_all_results($this->_table);
	}

	/**
	 *
	 * 通过订单id获取护工
	 * @param unknown_type $oid
	 */
	public function searchWorkerByOrderId($oid)
	{
		$sql = "select * from `oa_worker` as w left join `oa_worker_order` as o on w.worker_id = o.worker_id where ".
				"o.order_id = '".$oid."' and o.status = 1";
		$query = $this->db->query($sql);
		if($query){
			$info = $query->row_array();
		}
		return $info;
	}

	/**
	 *
	 * 搜索护工
	 * @param unknown_type $keyword
	 */
	public function searchWorker($keyword, $hospitalId = 0)
	{
		if($hospitalId != 0){
			$this->db->where('worker_hospital', $hospitalId);
		} 
		$this->db->where('worker_no', $keyword);
		$this->db->or_where('worker_name', $keyword);
		$this->db->or_where('worker_phone', $keyword);
		$this->db->order_by('worker_id', 'DESC');
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}

	/**
	 *
	 * 增加
	 * @param unknown_type $worker_phone
	 * @param unknown_type $worker_sex
	 * @param unknown_type $worker_domicile_province
	 * @param unknown_type $worker_domicile_city
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
	 * @param unknown_type $worker_id
	 * @param unknown_type $worker_phone
	 * @param unknown_type $worker_sex
	 * @param unknown_type $worker_domicile_province
	 * @param unknown_type $worker_domicile_city
	 */
	public function update($data)
	{

        $this->db->where('worker_id', $data['worker_id']);
		$this->db->update($this->_table, $data);
	}

	/**
	 *
	 * 获取护工信息
	 * @param unknown_type $worker_id
	 */
	public function getWorkerInfo($worker_id)
	{
		$query = $this->db->get_where($this->_table, array('worker_id' => $worker_id));
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
	public function del($worker_id)
	{
		$this->db->where('worker_id', $worker_id);
		$this->db->delete($this->_table);
	}

	/**
	 *
	 * 通过医院科室查询护工
	 * @param unknown_type $hids
	 */
	public function queryworkerByHospital($hids)
	{
		$this->db->where_in('worker_stationary', $hids);
		$info = array();
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}

	/**
	 *
	 * 护工统计
	 * @param unknown_type $keydata
	 */
	public function statWorker($keydata)
	{
		if(!empty($keydata['worker_hospital'])){
			$this->db->where('worker_hospital', $keydata['worker_hospital']);
		}
		if(!empty($keydata['worker_stationary'])){
			$this->db->where('worker_stationary', $keydata['worker_stationary']);
		}
		if(!empty($keydata['worker_status'])){
			$this->db->where('worker_status', $keydata['worker_status']);
		}
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}

	/**
	 *
	 * 批量更新
	 * @param unknown_type $workerList
	 * @param unknown_type $data
	 */
	public function updateBatch($workerList, $data)
	{
        $this->db->where_in('worker_id', $workerList);
		$this->db->update($this->_table, $data);
	}

	/**
	 *
	 * 通过指定信息查询护工
	 * @param unknown_type $serverType
	 * @param unknown_type $serverMode
	 * @param unknown_type $status
	 */
	public function queryWorkerByInfo($serverType, $serverMode, $status, $hospitalId = 0)
	{
		$this->db->where_in('worker_status', $status);
		$this->db->where('worker_service', $serverType);
		$this->db->where('worker_service_mode', $serverMode);
		if($hospitalId != 0){
			$this->db->where('worker_hospital', $hospitalId);
		}
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}

	/**
	 * 护工评价统计
	 */
	 public function statComment(){
	 	$this->db->select('sum(a.attitude_level) as sumale,sum(a.profession_level) as sumple,sum(a.discipline_level) as sumdle,count(a.comment_worker_id) as ccw,b.worker_hospital,b.worker_stationary,b.worker_id');
        $this->db->from('oa_comment as a');
        $this->db->join('oa_worker as b', 'a.comment_worker_id = b.worker_id');
        $this->db->group_by('a.comment_worker_id');
        $query = $this->db->get();
		if($query){
			$info = $query->result_array();
		}
		return $info;
	 }

	 /**
	 * 获取护工客户评价
	 */
	 public function getCommentList($worker_id){
	 	$this->db->select('a.*');
        $this->db->from('oa_comment as a');
        $this->db->join('oa_worker as b', 'a.comment_worker_id = b.worker_id');
        $this->db->where('a.comment_worker_id',$worker_id);
        $this->db->order_by('a.comment_time desc');
        $query = $this->db->get();
		if($query){
			$info = $query->result_array();
		}
		return $info;
	 }

	 /**
	 * 获取护工评分
	 */
	 public function getCommentLevel($worker_id){
	 	$this->db->select('sum(a.attitude_level) as sumale,sum(a.profession_level) as sumple,sum(a.discipline_level) as sumdle,count(a.comment_worker_id) as ccw');
        $this->db->from('oa_comment as a');
        $this->db->join('oa_worker as b', 'a.comment_worker_id = b.worker_id');
        $this->db->where('a.comment_worker_id',$worker_id);
        $this->db->group_by('a.comment_worker_id');
        $query = $this->db->get();
		if($query){
			$info = $query->row_array();
		}
		return $info;
	 }
}