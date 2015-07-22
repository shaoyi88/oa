<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 知识库模型类
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
    /*
    *获取菜单树型结构
    */
    public function getlist($pid,$allNav = NULL){
        if($allNav ===NULL){
            $allNav = $this->_getAll();
        }
        $res = array();
        $this->_getSubList($res, $allNav, $pid, 0);
        return $res;

    }
    /**
     *
     * 获取子菜单
     * @param unknown_type $res
     * @param unknown_type $allNav
     * @param unknown_type $allNav
     * @param unknown_type $level
     */
    private function _getSubList(&$res, $allNav, $pid, $level)
    {
        foreach($allNav as $item){
            if($item['cat_pid'] == $pid){
                $item['level'] = $level;
                $res[] = $item;
                $this->_getSubList($res,$allNav,$item['cat_id'],$level+1);
            }
        }
    }

    /**
     *获取所有信息
     */
    private function _getAll()
    {
        $cat = array();
        $query = $this->db->get($this->_table);
        if($query){
            $cat = $query->result_array();
        }
        return $cat;
    }

    /**
    *判定id是否存在下级菜单
     */
    public function titleCheck($cat_id){
        $this->db->where("cat_pid",$cat_id);
        $query = $this->db->get($this->_table);
        $res = array();
        if($query){
            $res = $query->row_array();
        }
        return $res;
    }

    /**
     *获取cat_id对应菜单
     */
    public function titleCatid($cat_id){
        $this->db->where("cat_id",$cat_id);
        $query = $this->db->get($this->_table);
        if($query){$res = $query->row_array(); }return $res;
    }

    /**
     *判定id是否存详细内容
     */
    public function contentCheck($cat_id){
        $this->db->where("cat_id",$cat_id);
        $query = $this->db->get($this->_infoTable);
        $res = array();
        if($query){
            $res = $query->row_array();
        }
        return $res;
    }

    /**
    *获取cat_id对应内容
     */
    public function contentCatid($key,$cat_id){
        $query = $this->db->query("select * from $this->_infoTable where $key= $cat_id");
        if($query){
            return $query->result_array();
        }
    }

    /**
     * 增加一个菜单
     */
    public function titleAdd($cat_pid,$cat_name)
    {
        $data = array(
            'cat_pid' 	=> $cat_pid,
            'cat_name' 	=> $cat_name,
            'cat_time' 	=> date('y-m-d',time()),
        );
        $this->db->insert($this->_table, $data);
        if($this->db->affected_rows() <= 0){return FALSE;} else{return TRUE;}
    }

    /**
     * 更新一个菜单
     */
    public function titleUpdate($data,$cat_id){
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
     * 删除一个菜单
     */
    public function titleDel($cat_id){
        $this->db->where('cat_id', $cat_id);
        $this->db->delete($this->_table);
    }
    /**
     * 删除一条知识记录
     */
    public function contentDel($cat_id){
        $this->db->where('cat_id', $cat_id);
        $this->db->delete($this->_infoTable);
        if($this->db->affected_rows() <= 0){return FALSE;} else{return TRUE;}
    }

    //增加一条记录
    public function contentAdd($condition){
        $data = array(
            'cat_id' 		=> $condition['cat_id'],
            'info_title' 	=> $condition['info_title'],
            'info_detail' 	=> $condition['info_detail'],
            'info_order' 	=> $condition['info_order'],
            'add_time' 		=> date('y-m-d',time()),
        );
        $this->db->insert($this->_infoTable, $data);
        if($this->db->affected_rows() <= 0){return FALSE;} else{return TRUE;}
    }

    public function contentUpdate($condition,$info_id){
        $data = array(
            'cat_id' 		=> $condition['cat_id'],
            'info_title' 	=> $condition['info_title'],
            'info_detail' 	=> $condition['info_detail'],
            'info_order' 	=> $condition['info_order'],
            'add_time' 		=> date('y-m-d',time()),
        );
        $this->db->where('info_id', $info_id);
        $this->db->update($this->_infoTable,$data);
        if($this->db->affected_rows() <= 0){return FALSE;} else{return TRUE;}
    }

    //删除一条内容
    public function contentDelete($info){
        $this->db->where('info_id', $info);
        $this->db->delete($this->_infoTable);
        if($this->db->affected_rows() <= 0){return FALSE;} else{return TRUE;}
    }
}