<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Knowledge extends OA_Controller 
{	
	// 初始化变量
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}
	function __construct(){
		parent::__construct();
		$this->load->model('OA_Knowledge');
	}

	//测试短信接口
	public function smsMsg(){
//		$this->load->helper('sms');
//		$apikey = SMSAPPIKEY; //请用自己的apikey代替
//		$mobile = "15914308649"; //请用自己的手机号代替
//		$text="【一家依】您的验证码是1234";
//		echo send_sms($apikey,$text,$mobile);

		//返回码
		// {"code":0,"msg":"OK","result":{"count":1,"fee":1,"sid":2260245741}}

		// send_sms($apikey, $text, $mobile);
		/**
		* 通用接口发短信
		* apikey 为云片分配的apikey
		* text 为短信内容
		* mobile 为接受短信的手机号
		*/
		
		// tpl_send_sms($apikey, $tpl_id, $tpl_value, $mobile)
		/**
		* 模板接口发短信
		* apikey 为云片分配的apikey
		* tpl_id 为模板id
		* tpl_value 为模板值
		* mobile 为接受短信的手机号
		*/
	}


    /**
     *
     *菜单管理
     */
    public function add_title(){
        $data = array();
        if(checkRight('knowledge_management') === FALSE){
            $this->showView('denied', $data);
            exit;
        }
        if($this->input->get('msg')){
            $data['msg'] = $this->input->get('msg');
        }
        $data['nav'] = $this->OA_Knowledge->getlist('0');
        $this->showView('knowledgeTitle', $data);
    }

    //添加一个菜单
    public function titleAdd()
    {
        $data = array();
        if(checkRight('knowledge_management') === FALSE){
            $this->showView('denied', $data);
            exit;
        }
        $data = $this->input->post();
        $condition['cat_id'] = $data['pid'] ? $data['pid'] : 0;
        $condition['cat_name'] = $data['cat_name'];
        if(!empty($condition['cat_name'])){
            $this->OA_Knowledge->titleAdd($condition['cat_id'],$condition['cat_name']);
            $msg = '?msg='.urlencode('菜单添加成功!');
        }else{
            $msg = '?msg='.urlencode('添加失败!');

        }
        redirect(formatUrl('knowledge/add_title'.$msg));
    }

    //更新一个菜单
    public function titleUpdate(){
        $data = $this->input->post();
        $condition['cat_id'] = $data['cat_id'];
        $condition['cat_name'] = $data['cat_name'];
        $condition['cat_time'] = date('y-m-d',time());
        if(!empty($condition['cat_id'])){
            $this->OA_Knowledge->titleUpdate($condition,$condition['cat_id']);
            $msg = '?msg='.urlencode('菜单更新成功!');
        }else{
            $msg = '?msg='.urlencode('菜单更新失败');
        }
        redirect(formatUrl('knowledge/add_title'.$msg));
    }

    //删除菜单是否存在下级，是否存在content
    public function titleDel(){
        $cat_id = $this->input->get('cid');
        if(count($this->OA_Knowledge->titleCheck($cat_id))>0){
            $msg = '?msg='.urlencode('该菜单存在下级菜单，删除失败!');
        }elseif(count($this->OA_Knowledge->contentCheck($cat_id))>0){
            $msg = '?msg='.urlencode('该菜单存在详细信息，删除失败!');
        }else{
            $this->OA_Knowledge->titleDel($cat_id);
            $msg = '?msg='.urlencode('删除菜单成功!');
        }
        redirect(formatUrl('knowledge/add_title'.$msg));
    }


    /**
    *内容管理界面
     */
    public function index(){
        $data = array();
        if(checkRight('knowledge_management') === FALSE){
            $this->showView('denied', $data);
            exit;
        }
        if($this->input->get('msg')){
            $data['msg'] = $this->input->get('msg');
        }
        $data['knowledgeTree'] = $this->OA_Knowledge->getlist(0);
        if(isset($data['knowledgeTree'][0]['cat_id'])){
            $pid = $data['knowledgeTree'][0]['cat_id'];
            if($this->input->get('pid', TRUE)){
                $pid = $this->input->get('pid', TRUE);
                log_message('info',$pid);
            }
            if(count($this->OA_Knowledge->titleCheck($pid))>0){
                $data['content'] = '';
            }else{
                $data['content'] = $this->OA_Knowledge->contentCatid('cat_id',$pid);
            }
        }
        $this->showView('knowledgeList', $data);
    }

    //增加或修改知识库内容
    public function contentChange(){
        if($this->input->get('msg')){
            $data['msg'] = $this->input->get('msg');
        }

        $data = '';
        if($this->input->get('msg')){
            $data['msg'] = $this->input->get('msg');
        }
        $id = $this->input->get('id');
        if(empty($id)){
            $data['type'] = "新增知识库内容";
        }else{
            $data['type']   = "更改知识库内容";
            $updateMsg = $this->OA_Knowledge->contentCatid('info_id',$this->input->get('id'));
            $data['updateMsg'] = $updateMsg;
            $data['updateMsgTitle'] = $this->OA_Knowledge->titleCatid($updateMsg[0]['cat_id']);
        }
        $data['nav'] = $this->OA_Knowledge->getlist('0');
        $this->showView('knowledgeContentAdd',$data);
    }

    //增加或修改一条内容
    public function contentAdd(){
        $condition = array();
        $changeValue= $this->input->post();
        $condition['info_title']    = $changeValue['info_title'];
        $condition['info_order']    = $changeValue['info_order'];
        $condition['info_detail']   = $changeValue['info_detail'];

        $res = $this->OA_Knowledge->titleCheck($condition['cat_id']);
        if(!empty($res)){
            $msg = '?msg='.urlencode('所选菜单存在下级标题，能添加菜单!');
            redirect(formatUrl('knowledge/contentChange'.$msg));
        } else{
            if($this->input->post('info_cat_id')){
                $condition['cat_id']        = $changeValue['info_cat_id'];
                $this->OA_Knowledge->contentUpdate($condition,$changeValue['info_id']);
                $msg = '?msg='.urlencode('更新操作成功!').'&pid='.$condition['cat_id'];
            } else{
                $condition['cat_id']        = $changeValue['cat_id'];
                $this->OA_Knowledge->contentAdd($condition);
                $msg = '?msg='.urlencode('添加操作成功!').'&pid='.$condition['cat_id'];
            }
            redirect(formatUrl('knowledge/index'.$msg));
        }
    }

    //删除一条知识库记录
    public function contentDel(){
        $info_id = $this->input->get('pid');
        log_message('info',$info_id);
        $res = $this->OA_Knowledge->contentDelete($info_id);
        if($res===TRUE){
            $msg = '?msg='.urlencode('删除操作成功!');
            redirect(formatUrl('knowledge/index'.$msg));
        }
        else{
            $msg = '?msg='.urlencode('删除操作失败!');
            redirect(formatUrl('knowledge/index'.$msg));
        }

    }

}	