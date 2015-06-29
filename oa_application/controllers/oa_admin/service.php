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

    public function change_to_processed(){
//        $params = file_get_contents('php://input', true);
        $params = $this->input->get();
        $this->load->model('OA_Appointment');
        $result =  $this->OA_Appointment->update_to_processed($params['id']);
        $status = array();
        if(!$result){
            $status['status'] = 200;
        }else{
            $status['status'] = 500;
            $status['error_msg'] = '无法找到相应的条目';
        }
        $this->send_json($status);
    }
}