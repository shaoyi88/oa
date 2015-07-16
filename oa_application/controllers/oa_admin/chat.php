<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Chan
 * Date: 15/7/10
 * Time: 上午9:00
 */

use Overtrue\Wechat\Server;

class Chat extends OA_Controller
{
    protected function initialize()
    {
        parent::initialize();
        checkLogin();
    }

    public function index(){
        echo 3;
        $this->load->library('Wechat');
        echo $this->wechat->test();
    }

    public function validate(){
        $appId          = 'wx3cf0f39249eb0e60';
        $token          = 'hellotest';
        $encodingAESKey = 'EJThPazwzO4k1cyXJnwQtL60zBdhWvFaHb4emv0dLVN'; // 可选

//$encodingAESKey 可以为空
        $server = new Server($appId, $token, $encodingAESKey);

    }

}
