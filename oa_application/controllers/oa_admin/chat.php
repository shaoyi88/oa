<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
define('WECHAT_MASTER_PATH', THIRD_PATH.'wechat-master/');

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
        require_once WECHAT_MASTER_PATH.'autoload.php';
    }

    public function index(){
        echo 3;
        $this->load->library('Wechat');
        echo $this->wechat->test();
    }

    public function validate(){
        echo 21;

        $appId          = 'wx9d24912c87f38ef5';
        $token          = 'hellotest';
        $encodingAESKey = 'haSfPHurdtqIgkGkwY9A9PMBlSbbDnnlQ9WWyDuTE8u'; // 可选

//$encodingAESKey 可以为空
        $server = new Server($appId, $token, $encodingAESKey);
        echo 22;
        $server->serve();
        echo 222;

        echo 23;
    }

}
