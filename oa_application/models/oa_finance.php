<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * 财务模型类
 * @author Administrator
 *
 */
class OA_Finance extends CI_Model
{
	private $_bill = 'oa_bill';
	private $_balance = 'oa_worker_order';
	private $_collect = 'oa_order_collection';

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
	 * 获取票据
	 */
	public function getBill($offset, $limit)
	{
		$info = array();
		$this->db->order_by('bill_id','DESC');
		$query = $this->db->get($this->_bill, $limit, $offset);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}

	/**
	 *
	 * 获取票据数
	 */
	public function getBillCount()
	{
		return $this->db->count_all_results($this->_bill);
	}

	/**
	 *
	 * 搜索票据
	 * @param unknown_type $keyword
	 */
	public function searchBill($keyword=array())
	{
		if(isset($keyword['received'])&&$keyword['received']){
			$this->db->where('received', $keyword['received']);
		}
		if(isset($keyword['keyword'])&&$keyword['keyword']){
			$this->db->where('receiptor', $keyword['keyword']);
		}
		if(isset($keyword['bill_id'])&&$keyword['bill_id']){
			$this->db->where('bill_id', $keyword['bill_id']);
		}
		$query = $this->db->get($this->_bill);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}

	/**
	 *
	 * 添加票据
	 */
	public function addbill($data)
	{
		$this->db->insert($this->_bill, $data);
		if($this->db->affected_rows() <= 0){
			return FALSE;
		}
		return TRUE;
	}

	/**
	 *
	 * 作废
	 */
	public function canbill($data)
	{
        if(!$data['bill_id']){
        	return FALSE;
        }
        $this->db->where('bill_id', $data['bill_id']);
		$this->db->update($this->_bill, $data);
	}

	/**
	 * 护工对账
	 */
	public function sumSalary($data)
	{
		$info = array();
		$this->db->select('FROM_UNIXTIME(end_time,"%Y%m") months,sum(salary) sumsalary,b.worker_name,b.worker_id,c.stationary_name',false);
		$this->db->from('oa_worker_order as a');
		if(isset($data['worker_hospital'])&&$data['worker_hospital']){
			$this->db->where('worker_hospital', $data['worker_hospital']);
		}
		if(isset($data['worker_stationary'])&&$data['worker_stationary']){
			$this->db->where('worker_stationary', $data['worker_stationary']);
		}
		$this->db->where('a.status', 0);
        $this->db->join('oa_worker as b', 'b.worker_id = a.worker_id');
        $this->db->join('oa_hospital as c', 'c.wb_id = b.worker_hospital');
        $this->db->group_by('months,a.worker_id');
        if(isset($data['salary_month'])&&$data['salary_month']){
			$this->db->having('months', $data['salary_month']);
		}
        $this->db->order_by('months desc,a.worker_id');
		$query = $this->db->get();
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}

	/**
	 * 护工对账详情
	 */
	public function getSalaryInfo($wid,$months)
	{
		$info = array();
        $this->db->select('a.*,FROM_UNIXTIME(end_time,"%Y%m") months,b.worker_name,b.worker_id,b.worker_hospital,b.worker_stationary,c.*,d.customer_name',false);
		$this->db->from('oa_worker_order as a');
		$this->db->where('a.worker_id', $wid);
		$this->db->where('a.status', 0);
		$this->db->join('oa_worker as b', 'b.worker_id = a.worker_id');
        $this->db->join('oa_order as c', 'c.order_id = a.order_id');
        $this->db->join('oa_customer as d', 'c.customer_id = d.customer_id');
        $this->db->having('months', $months);
        $this->db->order_by('end_time desc');
		$query = $this->db->get();
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}

	/**
	 *
	 * 获取收款数量
	 */
	public function getCollectCount()
	{

		return $this->db->count_all_results($this->_collect);
	}

	/**
	 *
	 * 获取收款
	 */
	public function getCollect($offset, $limit)
	{
		$info = array();
		$this->db->select('a.*,b.order_status,c.customer_name');
		$this->db->from('oa_order_collection as a');
		$this->db->join('oa_order as b', 'b.order_id = a.order_id');
        $this->db->join('oa_customer as c', 'c.customer_id = b.customer_id');
        $this->db->order_by('a.collection_id','DESC');
		$query = $this->db->get('', $limit, $offset);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}

	/**
	 *
	 * 搜索收款
	 * @param unknown_type $keyword
	 */
	public function searchCollect($keyword)
	{
		$this->db->select('a.*,b.order_status,c.customer_name');
		$this->db->from('oa_order_collection as a');
		$this->db->where('user_name', $keyword);
		$this->db->join('oa_order as b', 'b.order_id = a.order_id');
        $this->db->join('oa_customer as c', 'c.customer_id = b.customer_id');
		$query = $this->db->get();
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}

	/**
	 *
	 * 获取收款详情
	 */
	public function getCollectInfo($cid)
	{
		$info = array();
		$this->db->select('a.*,b.*,c.customer_name');
		$this->db->from('oa_order_collection as a');
		$this->db->where('collection_id', $cid);
		$this->db->join('oa_order as b', 'b.order_id = a.order_id');
        $this->db->join('oa_customer as c', 'c.customer_id = b.customer_id');
		$query = $this->db->get();
		if($query){
			$info = $query->row_array();
		}
		return $info;
	}

	/**
	 *
	 * 更新收款
	 */
	public function updateCollection($data){
		if($data['collection_id']){
			$this->db->where('collection_id', $data['collection_id']);
		    $this->db->update($this->_collect, $data);
		}
	}

	/**
	 *
	 * 作废
	 */
	public function cancollect($data)
	{
        if(!$data['collection_id']){
        	return FALSE;
        }
        $this->db->where('collection_id', $data['collection_id']);
		$this->db->update($this->_collect, $data);
	}

	/**
	 *
	 * 删除票据
	 */
	public function delbill($bid)
	{
		$this->db->where('bill_id', $bid);
		$this->db->delete($this->_bill);
	}

	/**
	 *
	 * 出票
	 */
	public function usebill($billno)
	{
		$sql = 'update oa_bill set used_num=used_num+1 where bill_no_start<='.$billno.' AND bill_no_end>='.$billno;
		$this->db->query($sql);
	}

}