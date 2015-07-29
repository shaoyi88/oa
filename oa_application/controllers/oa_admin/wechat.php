<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//加载微信sdk
define('WECHATSDK_PATH', THIRD_PATH.'Wechatsdk/');

use Overtrue\Wechat\Server;//微信接入验证sdk
use Overtrue\Wechat\Message;//回复信息类
use Overtrue\Wechat\Menu;//自定义菜单
use Overtrue\Wechat\MenuItem;//自定义菜单
use Overtrue\Wechat\Notice;//微信模板信息
use Overtrue\Wechat\Auth; //获取用户信息
//use Overtrue\Wechat\Message;//微信多客服信息

class Wechat extends OA_Controller
{

    protected function initialize()//     初始化变量
    {
        parent::initialize();
        require_once WECHATSDK_PATH.'autoload.php';
    }

    private $appId;
    private $token;
    private $encodingAESKey;
    private $appsecret;
    public function __construct(){
        parent::__construct();
        $this->appId = 'wx86b3751ad43f4062'; //一家依测试帐号
        $this->appsecret = 'f52a587fefed285df9244f310eee8a34';
        $this->encodingAESKey = 'V636dnTxFRxFb0qxwMtFComCPaOwkqtGBU5D8rbrbTE';
        $this->token = 'yijiayi';
        $this->windOpenid = 'o2DIYuMhcf3mBzpN3RZ_Rh9jiflU';
    }

    //微信接入，信息处理
    public function index(){
        $server = new Server($this->appId,$this->token,$this->encodingAESKey);
        $server->on('event', function($event) {
            log_message('info',$event);
        });

        $server->on('event', 'subscribe', function($event){//关注事件
            return Message::make('text')->content('你好，欢迎关注一家依公众号！');
        });

        $server->on('event','Click',function($click){//点击事件
            switch($click['EventKey']){
                case 'Getservice':
                    return Message::make('text')->content('你点击了在线客服按钮');break;
                case '开发中':
                    return Message::make('text')->content('点击事件正在开发中');break;
                default:
                    return Message::make('text')->content('点击事件正在开发中');break;
            }
        });

        // 关键字回复
        $server->on('message','text',function($message) {
            log_message('info',$message);
            switch($message['Content']){
                case '1':
                    return Message::make('text')->content('小程已经很努力啦！');break;

                case 'wind':
                    return Message::make('text')->content('程序员正在玩命开发中!');break;

                case '客服':
                    return Message::make('text')->content('请等待，客服马上就来了!');break;
                    return Message::make('transfer');break;

                case '2222':
                    $openid = $message['FromUserName'];
                    $templateid = 'OwlWliZpdl0O3cm7C5GJP9k1LW2I3E2fyt1mz37GDOA';
                    $data =  array(
                        "first"    => "张三您好，您的最近一期健康报告已生成，详情如下。",
                        "keyword1" => "2014年7月21日 18:36",
                        "keyword2" => "各项指标均不正常，请进一步检查。总体评分为零",
                        "remark"   => "欢迎再次购买！",
                    );
                    $this->templateSend($openid,$templateid,'',$data);break;
                case '3333':
                    $openid1 = $message['FromUserName'];
                    $templateid1 = 'nP4fAUPrJc-r4RLHmSytRAfsc7EfvYxe-uQp-F-6Sik';
                    $url1 = 'http://www.baidu.com';
                    $data1 = array(
                        "first"    => "张三您好，您的最近一期健康报告已生成，详情如下。",
                        "keynote1" => "2014年7月21日 18:36",
                        "keynote2" => "各项指标均不正常，请进一步检查。总体评分为零",
                        "keynote3"   => "欢迎再次购买！",
                        "keynote4"   => "欢迎再次购买！",
                        "remark"   => "欢迎再次购买！",
                    );
                    $this->templateSend($openid1,$templateid1,$url1,$data1);break;
                default:
            }
        });
        // 监听图片
        $server->on('message', 'image', function($img) {
            log_message($img);
            return Message::make('text')->content('我们已经收到您发送的图片！');
        });
        echo $server->serve();//接入微信公众帐号
    }

    /*
     * 发送模版信息
     *$userId string
     *$templateId string //微信模版id
     * $url 模版跳转链接，可以设置为空
     * $data array
     */
    public function templateSend($userId,$templateId,$url,$data){
        $notice = new Notice($this->appId, $this->appsecret);
        $res  = $notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($userId)->send();
        return $res;
    }

    /*
     *授权页面获取用户信息cd
    */
    public function getUserMsg(){
        $tourl = $this->input->get('url');
        $auth = new Auth($this->appId,$this->appsecret);
        $userMsg = $auth->authorize($to = null, $scope = 'snsapi_userinfo', $state = 'STATE');

//        $token = $auth->refresh_token;// 获取本次授权后的 refresh_token
//        log_message('info',$token);
        $msg = '?openid='.$userMsg['openid'].'&nickname='.$userMsg['nickname'].'&sex='.$userMsg['sex'].'&language='.$userMsg['language'].'&city='.$userMsg['city'].'&province='.$userMsg['province'].'&country='.$userMsg['country'].'&headimgurl='.$userMsg['headimgurl'].'&privilege='.$userMsg['privilege'];

        redirect($tourl.$msg);
    }

    public function cheng(){
        $res = $this->input->get();
        print_r($res);
        $openid1 = $res['openid'];
        $templateid1 = 'nP4fAUPrJc-r4RLHmSytRAfsc7EfvYxe-uQp-F-6Sik';
        $url1 = 'http://www.baidu.com';
        $data1 = array(
            "first"    => "张三您好，您的最近一期健康报告已生成，详情如下。",
            "keynote1" => "2014年7月21日 18:36",
            "keynote2" => "各项指标均不正常，请进一步检查。总体评分为零",
            "keynote3"   => "欢迎再次购买！",
            "keynote4"   => "欢迎再次购买！",
            "remark"   => "欢迎再次购买！",
        );
        echo $this->templateSend($openid1,$templateid1,$url1,$data1);

    }

    public function getToken(){

    }

}
?>