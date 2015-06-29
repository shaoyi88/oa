<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/6/29
 * Time: 11:25
 */

class OA_Appointment extends CI_Model
{
    private $_table = 'yjy_service_appointment';
    private $step = 10;
    private $start_index = 0;

    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getAppointment($type='all'){
        $this->db->select('s.id, s.confirm_time, s.contact_time, s.state,
         s.relationship, s.name, s.phone, s.easy_time,a.province, a.city,
          a.town, a.zone, a.stree, a.contact_name, a.contact_phone, u.nick_name, u.login_name');
        $this->db->from('yjy_service_appointment as s');
        $this->db->join('yjy_user_address as a', 's.address_id = a.id');
        $this->db->join('yjy_user as u', 's.user_id = u.id');
        $this->db->order_by('s.id desc');
//        $this->db->limit(10);


        //TODO：此处应该再优化一点，这样写没有扩展性
        switch($type){
            case 'unprocessed':
                $this->db->where('state', 1000);
                break;
            case 'processed':
                $this->db->where('state', 2000);
                break;
            case 'all':
                break;
            default:
                break;
        }

        $query = $this->db->get();
        if($query){
            $rows = $query->result();
            if(!empty($rows)){
                return $rows;
            }else{
                return false;
            }
        }
    }

    public function update_to_processed($id){
        if(!empty($id)){
            try{
                $data = array(
                    'state' => 2000
                );
                $this->db->where('id', $id);
                $this->db->update($this->_table, $data);
//                $this->db->set('contact_time' , date('Y-m-d H:i:s'), false);
                return true;
            }catch(Exception $e){
                return $e->getMessage();
            }

        }else{
            return false;
        }
    }


}