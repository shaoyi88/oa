<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: cheaboar
 * Date: 2015/6/28
 * Time: 21:47
 */

class service extends OA_Controller
{
    protected function initialize()
    {
        parent::initialize();
        checkLogin();
    }

    public function appointment_management(){
        $data['test'] = 123;
        $this->showView('service/appointment_management', $data);
    }

    public function user_management(){
        echo 'user management';
    }

    public function get_appointment(){
        $params =  $this->input->get();
        $this->load->model('OA_Appointment');

        $result = $this->OA_Appointment->getAppointment($params['type']);
        $return  = array();
        $serviceTypeConf = $this->config->item('customer_service_type');
        foreach($result as $r){
            $r = (array)$r;
            $r['service_type_name'] = $serviceTypeConf[$r['service_type']];
            try{
                $r['create_time_str'] = date('Y-m-d H:i:s', $r['create_time']);
            }catch (Exception $e){

            }

            $r['address_str'] = $r['provinceName'] . $r['cityName'] . $r['areaName'] . $r['address'] . $r['hospitalName'] .$r['departmentName'] . $r['other_address'];
            $return[] = $r;
        }

        $this->send_json($return);
    }

    /*
     *改变订单的状态为已处理，这里是临时开发阶段，下一阶段需完善
     * */
    public function change_to_processed(){

        $params = $this->input->get();
        $this->load->model('OA_Appointment');
        $result =  $this->OA_Appointment->update_to_processed($params['id']);
        $status = array();
        if($result == true){
            $status['status'] = 200;
            $status['contact_time'] = date('Y-m-d H:i:s');
        }else{
            $status = array(
                'status' => 500,
                'error_msg' => $result
            );
//            $status['status'] = 500;
//            $status['error_msg'] = $result.getMessage();
        }
        $this->send_json($status);
    }
}