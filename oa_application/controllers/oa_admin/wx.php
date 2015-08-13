<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//加载微信sdk
define('WECHATSDK_PATH', THIRD_PATH.'wechat-master/');

use Overtrue\Wechat\Server;//微信接入验证sdk
use Overtrue\Wechat\Message;//回复信息类
use Overtrue\Wechat\Menu;//自定义菜单
use Overtrue\Wechat\MenuItem;//自定义菜单
use Overtrue\Wechat\Notice;//微信模板信息
use Overtrue\Wechat\Auth; //获取用户信息
//use Overtrue\Wechat\Message;//微信多客服信息

class Wx extends OA_Controller
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
        $this->config->load('yijiayi_conf', TRUE);
        $this->yijiayi_conf = $this->config->item('yijiayi_conf');
        $this->appId            = $this->yijiayi_conf['appId']; //一家依测试帐号
        $this->appsecret        = $this->yijiayi_conf['appSecret'];
        $this->encodingAESKey   = $this->yijiayi_conf['encodingAESKey'];
        $this->token            = $this->yijiayi_conf['token'];
        $this->windOpenid       = 'o2DIYuMhcf3mBzpN3RZ_Rh9jiflU';
    }

    //微信接入，信息处理
    public function index(){
        $server = new Server($this->appId,$this->token,$this->encodingAESKey);
        $server->on('event', function($event) {
            log_message('info',$event);
        });

        $server->on('event', 'subscribe', function($event){//关注事件
            return Message::make('text')->content('谢谢你这么好看还关注我！从今往后，我们彼此都要努力，我负责跟你说些健康、母婴、养老资讯等方面的内容，你负责学习，拍砖，灌水，转发！ 然后。。。你会更加健康好看！');
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

                case 'openid':
                    return Message::make('text')->content($message['FromUserName']);
                    break;

                case '客服':
                    Message::make('text')->content('请等待，客服马上就来了!');
                    return Message::make('transfer');
                    break;
                case 'wind':
                    return $this->cheng();
                break;
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
     *授权页面获取用户信息
    */
    public function getUserMsg(){
        $tourl = $this->input->get('url');
        $auth = new Auth($this->appId,$this->appsecret);
        $userMsg = $auth->authorize($to = null, $scope = 'snsapi_userinfo', $state = 'STATE');
        $msg = '?openid='.$userMsg['openid'].'&nickname='.$userMsg['nickname'].'&sex='.$userMsg['sex'].'&language='.$userMsg['language'].'&city='.$userMsg['city'].'&province='.$userMsg['province'].'&country='.$userMsg['country'].'&headimgurl='.$userMsg['headimgurl'].'&privilege='.$userMsg['privilege'];
        redirect($tourl.$msg);
    }

    //测试模板发送
    public function cheng(){
        $openid1 = $this->windOpenid;
        $templateid1 = 'nP4fAUPrJc-r4RLHmSytRAfsc7EfvYxe-uQp-F-6Sik';
        $url1 = 'http://www.baidu.com';
        $data1 = array(
            "first"    => "您好，您的最近一期健康报告已生成，详情如下。",
            "keynote1" => "2014年7月21日 18:36",
            "keynote2" => "各项指标均不正常，请进一步检查。总体评分为零",
            "keynote3"   => "别再纠结了！",
            "keynote4"   => "快点拨打120吧！",
            "remark"   => "点击查看更多",
        );
        $this->templateSend($openid1,$templateid1,$url1,$data1);
    }
}
?>