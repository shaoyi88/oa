<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Weixin extends OA_Controller
{
//     初始化变量
    protected function initialize()
    {
        parent::initialize();
    }

    function __construct(){
        parent::__construct();
        $this->load->library('Wechat','','wind');
    }

    //token获取
    public function getToken(){
        print_r($this->wind->checkAuth());
    }

    //接入微信
    public  function login(){
        $this->wind->valid();
        $type = $this->wind->getRev()->getRevType();
        switch($type) {
            case Wechat::EVENT_SUBSCRIBE:
                $this->wind->text("欢迎关注一家依！")->reply();break;//关注事件
            case Wechat::MSGTYPE_TEXT:
                $getText = $this->wind->getRevContent();
                switch($getText){
                    case '回复':
                        $this->wind->getRevKFSwitch();break;
                    case '报告':
                        $this->templateMsg();exit;
                    case '小依':
                        $this->wind->text("hello！你发送的内容是".$getText)->reply();break;
                    case '董猪':
                    case '客服':
                        $this->wind->transfer_customer_service('wind1748@Don_fen')->reply();
                        log_message('info',"kefu-msg");
                        $this->wind->text("我是董猪，有什么可能帮到你呢？")->reply();break;
                    default:
                }
                break;
            case Wechat::MSGTYPE_EVENT:
                    $this->wind->getRevKFSwitch();
                break;
            case Wechat::MSGTYPE_IMAGE:
//
                break;
            default:
                $this->wind->text("hello, what can i do for you?")->reply();
        }
    }
    //获取自定义菜单

    public function getMenu(){
        $yjy_menu = $this->wind->getMenu();
        print_r($yjy_menu);
        echo "<br/>";
        var_dump($yjy_menu);
    }

    //自定义菜单设置
    public function menu(){
        $newmenu= array(
            'menu' =>  array(
                "button"=> array(
                    array('name'=>'子女必读','sub_button'=>array(
                        array('type'=>'view','name'=>'E家课堂','url'=>'http://www.ecare-easy.com/m/class.aspx?type=27','sub_button'=>''),
                        array('type'=>'view','name'=>'服务流程','url'=>'http://www.ecare-easy.com/m/serverprocess.aspx?autoid=9','sub_button'=>''),
                    )),
                    array('type' => 'view','name'=>'微商城','url'=>'http://www.ecare-easy.com/m/index.aspx','sub_button'=>''),
                    array('name'=>'会员中心','sub_button'=>array(
                        array('type'=>'click','name'=>'加入会员','key'=>'Member','sub_button'=>''),
                        array('type'=>'view','name'=>'服务流程','url'=>'http://www.ecare-easy.com/m/serverprocess.aspx?autoid=9','sub_button'=>''),
                        array('type'=>'view','name'=>'尊享优惠','url'=>'http://www.ecare-easy.com/m/content.aspx?id=12','sub_button'=>''),
                        array('type'=>'click','name'=>'市场调查','key'=>'Market_survey','sub_button'=>''),
                        array('type'=>'click','name'=>'联系客服','key'=>'Getservice','sub_button'=>''),
                    )),
                )
            )
        );
        $this->wind->createMenu($newmenu);
    }
    //发送模版消息

    public function templateMsg(){
        $data = array(
            'touser'        =>$this->wind->getRevFrom(),
            'template_id'   =>'OwlWliZpdl0O3cm7C5GJP9k1LW2I3E2fyt1mz37GDOA',
            'url'           =>'http://www.baidu.com',
            'topcolor'      =>'#173177',
            'data'          =>array(
                'first' => array(
                    'value' => "小依感谢您的支持！",
                    'color' => "#173177",
                ),
                'keyword1' => array(
                    'value' => date('y-m-d h-m-s',time()),
                    'color' => "#173177",
                ),
                'keyword2' => array(
                    'value' => '你的体检报告很差，120急救车正在赶往，你要坚持住',
                    'color' => "#173177",
                ),
                'remark' => array(
                    'value' => "点击查看急救车的位置",
                    'color' => "#173177",
                )
            ),
        );
        $this->wind->sendTemplateMessage($data);
    }
    //关注者列表

    public function allUser(){
        $user = $this->wind->getUserList();
        print_r($user);
        log_message('info',explode('glue',$user));
    }
    //获取分组用户

    public function groupUser(){
        print_r($this->wind->getGroup());

    }

    //获取关注用户的信息
    public function userMsg(){
        $openid = $this->wind->getRevFrom();
        $userMsg = $this->wind->getOauthUserinfo($this->wind->checkAuth(),$openid);
        print_r($userMsg);
    }
    //获取客服信息

    public function kefu(){
        $user = $this->wind->getCustomServiceKFlist();
        print_r($user);
        echo "<br/>";echo "<br/>";
        $user1 = $this->wind->getCustomServiceOnlineKFlist();
        print_r($user1);
        echo "<br/>";echo "<br/>";
        $user2 = $this->wind->checkAuth();
        print_r($user2);

        //客服在线接待状态
        echo "<br/>";echo "<br/>";
        $user3 = $this->wind->getCustomServiceOnlineKFlist();
        print_r($user3);

    }

}
?>