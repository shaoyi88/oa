<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
define('WECHAT_MASTER_PATH', THIRD_PATH.'wechat-master/');
require WECHAT_MASTER_PATH."autoload.php";


/**
 * Created by PhpStorm.
 * User: Chan
 * Date: 15/7/10
 * Time: 上午9:00
 */

use Overtrue\Wechat\Server;
use Overtrue\Wechat\Message;
use Overtrue\Wechat\Menu;
use Overtrue\Wechat\MenuItem;
use Overtrue\Wechat\User;


class Validation extends OA_Controller
{
    private $server;
    private $appId;
    private $secret;
    private $wechat_conf;

    protected function initialize()
    {
        parent::initialize();
        $this->config->load('wechat_conf', TRUE);

        $this->wechat_conf = $this->config->item('wechat_conf');

        $this->appId          = $this->wechat_conf['appId'];
        $token          = $this->wechat_conf['token'];
        $encodingAESKey = $this->wechat_conf['encodingAESKey'];
        $this->secret = $this->wechat_conf['secret'];
        //$encodingAESKey 可以为空
        $this->server = new Server($this->appId, $token, $encodingAESKey);



    }

    static function get_user_info($openId){
        $userService = new User('wxb468b850fc76d278', 'b4843edb87fc8e3f0b1034bf946c5189');
        $user = $userService->get($openId);

        return $user;
    }


    public function valid(){
        log_message('info', 'Enter valid');

        // 监听所有类型
        $this->server->on('message', function($message) {
            log_message('info',$message);
            $user_info = Validation::get_user_info($message['FromUserName']);

            log_message('info', $user_info);
            log_message('info', '23');
            return Message::make('text')->content('您的消息我们已收到！');
        });


        // 监听关注事件
        $this->server->on('event', 'subscribe', function($event) {

            log_message('info','收到关注事件，关注者openid: ' . $event['FromUserName']);

            return Message::make('text')->content('感谢您关注');
        });


        // 监听取消关注事件
        $this->server->on('event', 'unsubscribe', function($event) {

            log_message('info','收到关注事件，关注者openid: ' . $event['FromUserName']);

            return Message::make('text')->content('感谢您关注');
        });

        $result = $this->server->serve();

        echo $result;

    }

    public function show_menus(){

        $menus = $this->config->item('wechat_conf');
        $appId = $this->config->item('appId');
        var_dump($menus);
        var_dump($menus['subcribe_menus']);
    }

    public function set_menus(){
        $menuR = new Menu($this->appId, $this->secret);
        $target = array();

        $menus = $this->wechat_conf['subcribe_menus'];
        foreach($menus as $menu){
            $item = new MenuItem($menu['name'], $menu['type'], $menu['key']);

            if(!empty($menu['buttons'])){
                $buttons = array();

                $buttons_item = $menu['buttons'];

                foreach($buttons_item as $button){
                    $buttons[] = new MenuItem($button['name'], $button['type'], $button['key']);
                }

                $item->buttons($buttons);
            }

            $target[] = $item;
        }

        $menuR->set($target); // 失败会抛出异常

        echo '设置成功';
    }




}
