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
		$this->load->model('Oa_User');
        $server = new Server($this->appId,$this->token,$this->encodingAESKey);
        $server->on('event', function($event) {
			$up_data['wechat_openid']		=	$event['FromUserName'];
			$up_data['focus_status']		=	2;
			$this->Oa_User->updateforopenid($up_data);
            log_message('info',$event);
        });

        $server->on('event', 'subscribe', function($event){//关注事件
			//加入会员信息表操作，标示会员关注状态
			$this->load->model('Oa_User');
			$result	=	$this->Oa_User->selForwxid($event['FromUserName']);

			if($result){
				
			  $up_data['user_id']		=	$result['user_id'];
			  $up_data['focus_status']	=	1;
			  $this->Oa_User->update($up_data);
			}else{
				   $data = array(
						'wechat_openid' => $event['FromUserName'],
						'focus_status'=>1
					);
					$this->Oa_User->add($data);
			}
			
            return Message::make('text')->content('亲，欢迎关注一家依，一家依致力于成为华南地区最受尊敬的居家养老、康复护理公司，提供居家照护、康复护理、医院陪护、月子照护等康复护理服务，如需预约，请点击“服务预约”。
			
一家依正在进行“最潮老爸老妈“评选活动，即将到来的重阳节，给老爸老妈送上一份大礼吧，除了能免费享受一家依一年的健康管理服务外，还能让老爸老妈享受一晚四季酒店江景房的尊贵服务哦。<a href="http://subcribe.ecare-easy.com/health/activity">去看看吧</a>！');
        });

        $server->on('event','Click',function($click){//点击事件
            switch($click['EventKey']){
                case 'CUSTOMER_SERVICE':
                    Message::make('text')->content('请等待，客服马上就来了!');
                    return Message::make('transfer');
                    break;

                default:
                    return Message::make('text')->content('开发中');break;
            }
        });

        // 关键字回复
        $server->on('message','text',function($message) {
            log_message('info',$message);
            switch($message['Content']){
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
}
?>