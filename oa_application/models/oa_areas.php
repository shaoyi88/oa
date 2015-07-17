<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 *	地区模型类
 * @author Administrator
 *
 */
class OA_Areas extends CI_Model
{
	private $_table = 'oa_areas';
	
	/**
	 * 初始化
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * 
	 * 通过子地区
	 * @param unknown_type $dids
	 */
	public function queryAreasByPid($pid)
	{
		$this->db->where('parent_id', $pid);
		$info = array();
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}
	
	/**
	 * 
	 * 获取id列表获取地区名列表
	 */
	public function getAreasNameListByIds($ids)
	{
		$info = $result = array();
		$this->db->where_in('area_id', $ids);
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		foreach($info as $item){
			$result[$item['area_id']] = $item['area_name'];
		}
		return $result;
	}
}