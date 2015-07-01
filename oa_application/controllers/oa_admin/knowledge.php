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

	/**
	 * 
	 * 知识库管理
	 */
	public function index()
	{	
		$data = array();
		if(checkRight('knowledge_management') === FALSE){
			$this->showView('knowledge', $data);
			exit;
		}
		// 所有的菜单
		$res = $this->OA_Knowledge->gettop_title('0');
		$checknav = array();
		$third_nav = array();
		foreach ($res as $key => $value) {
			$cat_id = $value['cat_id'];//获取顶级菜单

			$res_two = $this->OA_Knowledge->gettop_title($cat_id);
			array_push($third_nav, $res_two);
			array_push($checknav, array(
			    'cat_id'        => $cat_id,
			    'cat_name'      => $value['cat_name'],
			    'navtwo'    	=> $res_two,
			));
		}
		//三级菜单
		$res_nav_third = array();
		foreach ($third_nav as $key2 => $value2) {
			foreach ($value2 as $key3 => $value3) {
				$res_third = $this->OA_Knowledge->getall($value3['cat_id']);
				array_push($res_nav_third,array(
					'id' => $value3['cat_id'],
					'other' =>$res_third ,
					)
				);			
			}
		}
		$data = array();
		$data['navall'] = $checknav;
		$data['navthird'] = $res_nav_third;
		$this->showView('knowledge',$data);
	}

	/**
	*类目管理
	*/
	public function add_title(){
		$data = array();
		if(checkRight('knowledge_management') === FALSE){
			$this->showView('knowledge', $data);
			exit;
		}
		// 所有的菜单
		$res = $this->OA_Knowledge->gettop_title('0');
		$checknav = array();
		$third_nav = array();
		foreach ($res as $key => $value) {
			$cat_id = $value['cat_id'];//获取顶级菜单

			$res_two = $this->OA_Knowledge->gettop_title($cat_id);
			array_push($third_nav, $res_two);
			array_push($checknav, array(
			    'cat_id'        => $cat_id,
			    'cat_name'      => $value['cat_name'],
			    'navtwo'    	=> $res_two,
			));
		}
		//三级菜单
		$res_nav_third = array();
		foreach ($third_nav as $key2 => $value2) {
			foreach ($value2 as $key3 => $value3) {
				$res_third = $this->OA_Knowledge->getall($value3['cat_id']);
				array_push($res_nav_third,array(
					'id' => $value3['cat_id'],
					'other' =>$res_third ,
					)
				);			
			}
		}
		$data = array();
		$data['navall'] = $checknav;
		$data['navthird'] = $res_nav_third;
		$this->showView('knowledgeNav',$data);
	}

	/*
	*导航栏的管理，只设置可以更改上一级的目录
	*/ 
	function navManagement(){
		$cat_id = $this->uri->segment(4);
		$resNav = $this->OA_Knowledge->getContentNav($cat_id);
		$restopNav = $this->OA_Knowledge->getContentNav($resNav[0]['cat_pid']);
		$restopNavlist = $this->OA_Knowledge->getTopList($restopNav[0]['cat_pid']);
		$data['title'] = $restopNav[0]['cat_name'];
		$data['resoureNav'] = $resNav[0];
		$data['resoureList'] = $restopNavlist;
        // print_r($restopNav[0]['cat_name']);
		$this->showView('knowledgeNavManagement',$data);
	}

	/**
	*增加一个导航栏目
	*/ 
	public function addNav(){
		$cat_id = $this->uri->segment(4);
		if($cat_id == '0'){
			$data['cat_id'] 	= '0';
			$data['cat_name'] 	= '顶级目录';
		}else{
			$res = $this->OA_Knowledge->getContentNav($cat_id);
			$data['cat_id'] 	= $res[0]['cat_id'];
			$data['cat_name'] 	= $res[0]['cat_name']; 
		}
		//print_r($data);
		$this->showView('knowledgeAdd',$data);
	}
	/**
	*导航栏处理--添加
	*/ 
	public function navdata(){
		$data['cat_pid'] = $this->input->post('cat_pid');
		$data['cat_name'] = $this->input->post('cat_name');
		// $data['cat_pid'] = '1';
		// $data['cat_name'] ='测试';
		$data['cat_time'] = date('y-m-d',time());
		$resadd = $this->OA_Knowledge->addNav($data);
		if($resadd){
			$res['msg'] = 'ok';
		}else{
			$res['msg'] = 'false';
		}
		echo json_encode($res);
	}

	/**
	*导航栏处理--更新
	*/ 
	public function navupdate(){
		$cat_id = $this->input->post('cat_id');
		$condition = $this->input->post('cat_pid');
		$data['cat_name'] = $this->input->post('cat_name');	
		$data['cat_time'] = date('y-m-d',time());
		if($condition !='0'){
			$data['cat_pid'] = $condition;
		}
		$resadd = $this->OA_Knowledge->updateNav($data,$cat_id);
		if($resadd>'0'){
			$res['msg'] = 'ok';
		}else{
			$res['msg'] = 'false';
		}
		echo json_encode($res);
	}

	/**
	*删除指定id的对应的菜单
	*/ 
	public function navdel(){
		$cat_id = $this->input->post('cat_id');
		//查询所有下级目录
		// $resdel = $this->OA_Knowledge->getTopList($cat_id);
		

		$resdel = $this->OA_Knowledge->del_nav($cat_id);
		if($resdel>'0'){
			$res['msg'] = 'ok';
		}else{
			$res['msg'] = 'false';
		}
		echo json_encode($res);
	}

	/**
	*指定id的对应的一级菜单
	*/ 
	public function gettopNav(){
		$cat_id = $this->input->post('cat_pid');
		if(empty($cat_id)){
			return FALSE;
		}
		else {
			$data = $this->OA_Knowledge->getTopList($cat_id);
			echo json_encode($data);
		}
	}

	/**
	*三级以下菜单及内容返回
	*/
	public function detail(){
		$cat_id = $this->input->post('cat_pid');
		// $cat_id = "23";
		$count_nav = $this->OA_Knowledge->getTopList($cat_id);
		if (empty($count_nav)){//没有下级菜单了		
			$data['msg'] = 'content';
			$data['kenwledge_detail'] = $this->OA_Knowledge->getContent($cat_id,'cat_id');		
		}
		else{//有下级菜单	
			$data['msg'] = 'nav';
			$data['navdata'] = $count_nav;
		}
		print_r(json_encode($data));
	}	
	
	// 更改一条知识库的信息
	public function changeMsg(){
		$cat_id = $this->uri->segment(4);
		//echo $cat_id;
		$res = $this->OA_Knowledge->getContent($cat_id,'info_id');
		$data['yjy_info'] =  $res;
		// print_r($res);
		$data['infoTitle'] = $this->OA_Knowledge->getContentNav($res[0]['cat_id']);
		// print_r($res[0]['cat_id']);
		$this->showView('knowledgeChange',$data);
	}

	//删除一条知识库的信息
	public function deleteMsg(){
		$cat_id = $this->uri->segment(4);
		echo $cat_id;
		// print_r($_SERVER['HTTP_REFERER']);	
		redirect($_SERVER['HTTP_REFERER'],'location');	
	}

	//保存信息
	public function savechangeMsg(){
		$info_id 		= $this->input->post('info_id');
		$info_title 	= $this->input->post('info_title');
		$info_detail 	= $this->input->post('info_detail');
		$info_order 	= $this->input->post('info_order');
		$this->OA_Knowledge->update_content($info_id,$info_id,$info_title,$info_detail,$info_order);
		redirect('knowledge/index/', 'refresh');
	}

	/**
	*获取所有nav
	*/ 
	public function allnav(){
		$res = $this->OA_Knowledge->getall('0');
		$checknav = array();
		foreach ($res as $key => $value) {
			$cat_id = $value['cat_id'];//获取顶级菜单

			$res_two = $this->OA_Knowledge->getall($cat_id);
			array_push($checknav, array(
			    'topnav'        => $value,
			    $value['cat_id']    	=> $res_two,
			));
		}
		print_r($checknav);
	}
}	