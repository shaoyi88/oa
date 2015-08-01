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
	private $_admin = 'oa_admin';
	private $_role = 'oa_role';

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
		$this->db->select('a.*,b.admin_name');
		$this->db->from('oa_hospitaladvice as a');
		$this->db->join('oa_admin as b', 'b.admin_id = a.added_by');
		$this->db->group_by('a.advice_id');
		$this->db->order_by('a.advice_id desc');
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

	/**
	 * 获取相关部门跟进人员
	 * $id为发起意见建议者，为空时获取全部部门拥有跟进权限的人员
	 */
	public function getfollowlist($id=''){
		$adminlist = array();
		$sql = 'select admin_role,admin_name,admin_department,admin_phone from oa_admin ';
		if(isset($id)&&is_numeric($id)&&$id>1){
			$sql .= 'where admin_department in (select admin_department from oa_admin where admin_id='.$id.')';
		}
		$query = $this->db->query($sql);
		$info = $query->result_array();
		foreach($info as $v){
			$q = $roleinfo = $admin = array();
			if($v['admin_role']>0){
				$this->db->where('id', $v['admin_role']);
			    $q = $this->db->get($this->_role);
			    $roleinfo = $q->row_array();
			    $rightsArr = explode(',',$roleinfo['role_rights']);
		        if(in_array('hospitaladvice_follow',$rightsArr)){
			        $admin['admin_name'] = $v['admin_name'];
			        $admin['admin_department'] = $v['admin_department'];
			        $admin['admin_phone'] = $v['admin_phone'];
			        $adminlist[] = $admin;
		        }
			}

		}
		return $adminlist;
	}


}