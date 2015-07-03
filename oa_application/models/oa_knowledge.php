<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 关注病人模型类
 * @author Administrator
 *
 */
class OA_Knowledge extends CI_Model
{
	private $_table = 'yjy_knowledge_cat';
	private $_infoTable = 'yjy_knowledge_info';
	
	/**
	 * 初始化
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	

	/**
	 * 增加一个类目,非空判断，执行结果判断
	 */
	public function nav_add($cat_pid,$cat_name)
	{	
		if(empty($cat_name)){
			return FALSE;
		}else{		
			$data = array(
	            'cat_pid' 	=> $cat_pid,
	            'cat_name' 	=> $cat_name,
				'cat_time' 	=> date('y-m-d',time()),
	        );		
	 	 	$this->db->insert($this->_table, $data); 
       	 	if($this->db->affected_rows() <= 0){
				return FALSE;
			}
			else{
				return TRUE;
			}
		}
	}
	/**
	 * 增加一条知识库记录
	 */
	public function nav_content($cat_pid,$info_title,$info_detail,$info_order)
	{	
		if(empty($cat_pid)||empty($info_title)||empty($info_detail)){
			return FALSE;
		}else{		
			$data = array(
	            'cat_pid' 		=> $cat_pid,
	            'info_title' 	=> $info_title,
	            'info_detail' 	=> $info_detail,
	            'info_order' 	=> $info_order,
				'add_time' 		=> date('y-m-d',time()),
	        );		
	 	 	$this->db->insert($this->_infoTable, $data); 
       	 	if($this->db->affected_rows() <= 0){
				return FALSE;
			}
			else{
				return TRUE;
			}
		}
	}

	/**
	*读取知识库对应id的导航栏
	*/ 
	public function getContentNav($cat_id){
		$query = $this->db->query("select * from $this->_table where cat_id=".$cat_id);
		if($query){
			$res = $query->result_array();
		}
		return $res;
	}

	/**
	*查找id相同的栏位
	*/ 
	public function getTopList($cat_id){
		$query = $this->db->query("select * from $this->_table where cat_pid=".$cat_id);
		if($query){
			$res = $query->result_array();
		}
		return $res;
	}

	/**
	*读取知识库单条详细记录
	*/ 
	public function getContent($cat_id,$key){
		$query = $this->db->query("select * from $this->_infoTable where $key=".$cat_id);
		if($query){
			$res = $query->result_array();
		}
		return $res;
	}

	/**
	*删除标题
	*/
	public function del_nav($cat_id){
		$this->db->where('cat_id', $cat_id);
		$this->db->delete($this->_table);
		if($this->db->affected_rows() <= 0){
			return FALSE;
		}
		else{
			return TRUE;
		}
	}

	/**
	*删除一条内容
	*/
	public function del_content($cat_id){
		$this->db->where('cat_id', $cat_id);
		$this->db->delete($this->_infoTable);
		if($this->db->affected_rows() <= 0){
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
	

	/**
	*添加导航
	*/
	public function addNav($data){
		$this->db->insert($this->_table, $data); 
		if($this->db->affected_rows() <= 0){
			return FALSE;
		}
		return TRUE;
	}

	/**
	*更新导航
	*/
	public function update_nav($former_cat_id,$cat_id,$cat_pid,$cat_name){
		if(empty($former_cat_id)||empty($cat_id)||empty($cat_pid)||empty($cat_name)){
			return FALSE;
		}else{	
			$data = array(
				'cat_id' 	=> $cat_id,
		        'cat_pid' 	=> $cat_pid,
		        'cat_name' 	=> $cat_name,
				'cat_time' 	=> date('y-m-d',time()),
		    );
		    $this->db->where('cat_id', $former_cat_id);		    
		    $this->db->update($this->_table,$data); 
		}
		if($this->db->affected_rows() <= 0){
			return FALSE;
		}
		else{
			return TRUE;
		}
	}

	/**
	*更新一条内容记录
	*/
	public function updateNav($data,$cat_id){
	    $this->db->where('cat_id', $cat_id);		    
	    $this->db->update($this->_table,$data); 		
		if($this->db->affected_rows() <= 0){
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
 	/**
	*读取所有的content信息
	*/
	public function getall_knowledge(){
		$query = $this->db->query("select * from $this->_infoTable");
		if($query){
			$res = $query->result_array();
		}
		return $res;
	}
	/**
	*获取一级标题
	*/
	public function gettop_title($id){
		$query = $this->db->query("select * from $this->_table where cat_pid= $id");
		if($query){
			$res = $query->result_array();
		}
		return $res;
	}
	/**
	*获取子菜单
	*/ 
	public function getall($id){
		$query = $this->db->query("select * from $this->_table where cat_pid= $id");
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}
}