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
}