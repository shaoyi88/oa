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


        $this->db->select('s.id, s.other_address, h1.stationary_name as hospitalName, h2.stationary_name as departmentName, s.confirm_time, s.contact_time, s.state,s.easy_time, a1.area_name as provinceName, a2.area_name as cityName, a3.area_name as areaName, a.address,
        s.name as name, s.phone as phone, service_type, s.create_time');
        $this->db->from('yjy_service_appointment as s');
        $this->db->join('oa_address as a', 's.address_id = a.address_id', 'left');
        $this->db->join('oa_areas as a1', 'a.province = a1.area_id', 'left');
        $this->db->join('oa_areas as a2', 'a.city = a2.area_id', 'left');
        $this->db->join('oa_areas as a3', 'a.area = a3.area_id', 'left');
        $this->db->join('oa_hospital as h1', 'h1.wb_id = s.hospital_id', 'left');
        $this->db->join('oa_hospital as h2', 'h2.wb_id = s.department_id', 'left');
//        $this->db->join('oa_user as u', 's.user_id = u.user_id');
//        $this->db->join('yjy_service_info as service_info', 'service_info.id = s.service_id', 'left');
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
                $this->db->where('state !=', -1);
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
                return $this->db->error();
            }
        }
    }

    public function update_to_processed($id){
        if(!empty($id)){
            try{
                $data = array(
                    'state' => 2000,
                    'contact_time' => date('Y-m-d H:i:s')
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