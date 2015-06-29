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

        $this->send_json($this->OA_Appointment->getAppointment($params['type']));
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