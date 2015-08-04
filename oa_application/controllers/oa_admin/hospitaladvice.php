<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hospitaladvice extends OA_Controller
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}

	/**
	 *
	 * 意见建议跟进人员
	 */
	public function admin()
	{
		$data = $undeal = array();
		$nadmin = 0;
		$this->load->model('OA_Hospitaladvice');
		$id = '';
		if(checkRight('hospitaladvice_all') === FALSE){
			$id = $this->session->userdata('admin_id');
		}
		$dataList = $this->OA_Hospitaladvice->getfollowlist($id);
		$this->load->model('OA_Department');
		$dpname = $this->OA_Department->getDepartmentName();
		$data['dataList'] = $dataList;
		$data['dpname'] = $dpname;
		$key['advice_status'] = 2;
		$key['nadmin'] = $nadmin;
		$csList = $this->OA_Hospitaladvice->searchHp($key);
		foreach($csList as $val){
			if(!empty($val['appointed'])){
				if(!isset($undeal[$val['appointed']])){
				    $undeal[$val['appointed']] = 1;
			    }else{
				    $undeal[$val['appointed']]++;
			    }
			}
		}
		$data['undeal'] = $undeal;
		$this->showView('hospitaladviceAdmin', $data);
	}

	/**
	 *
	 * 意见建议列表
	 */
	public function advice_list()
	{
		$data = $post = $admininfo = array();
		if(checkRight('hospitaladvice_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$data['adminid'] = $this->session->userdata('admin_id');
		$data['admin'] = $this->session->userdata('admin_name');
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$this->load->model('OA_Hospitaladvice');
		$nadmin = 0;
		if($this->input->post()){
			$post = $this->input->post();
			if(checkRight('hospitaladvice_all') === FALSE){
			    $nadmin = 1;
			    $post['nadmin'] = $nadmin;
			    $post['added_by'] =  $data['adminid'];
			    $post['appointed'] =  $data['admin'];
		    }
			$dataList = $this->OA_Hospitaladvice->searchHp($post);
		}else{
			$offset = 0;
			$pageUrl = '';
			if(checkRight('hospitaladvice_all') === FALSE){
			    $nadmin = 1;
			    $admininfo['added_by'] =  $data['adminid'];
			    $admininfo['appointed'] =  $data['admin'];
		    }
			page(formatUrl('hospitaladvice/advice_list').'?', $this->OA_Hospitaladvice->getHpCount(), PER_COUNT, $offset, $pageUrl);
			$dataList = $this->OA_Hospitaladvice->getHp($offset, PER_COUNT, $nadmin, $admininfo);
			$data['pageUrl'] = $pageUrl;
		}
		$data['dataList'] = $dataList;
		$data['hpstatus'] = $this->config->item('hospitaladvice_status');
		$this->load->model('OA_Hospital');
		$data['nInfo'] = $this->OA_Hospital->getNameList();
		$this->showView('hospitaladviceList', $data);
	}

	/**
	 *
	 * 增加/编辑意见建议
	 */
	public function add()
	{
		$data = $ninfo = array();
		$this->load->model('OA_Hospital');
		$hospital = $this->OA_Hospital->queryByPid(0);
		if($this->input->get('id')){
			if(checkRight('hospitaladvice_add') === FALSE && checkRight('hospitaladvice_follow') === FALSE && checkRight('hospitaladvice_appoint') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$id = $this->input->get('id');
			$data['typeMsg'] = '编辑处理';
			$this->load->model('OA_Hospitaladvice');
			$data['info'] = $this->OA_Hospitaladvice->getHpInfo($id);
			$data['hpstatus'] = $this->config->item('hospitaladvice_status');
			$data['appointright'] = checkRight('hospitaladvice_appoint');
			if($data['info']['hospital_id']){
				$ninfo = $this->OA_Hospital->queryByPid($data['info']['hospital_id']);
			}
			$data['hplist'] = $this->OA_Hospitaladvice->getfollowlist($data['info']['added_by']);
			$data['ap'] = 0;
			if($this->input->get('ap')){
				$data['typeMsg'] = '指派';
				$data['ap'] = $this->input->get('ap');
			}
		}else{
			if(checkRight('hospitaladvice_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data['typeMsg'] = '新增';
		}
		$data['hospitalInfo'] = $hospital;
		$data['nInfo'] = $ninfo;
		$this->showView('hospitaladviceAdd', $data);
	}

	/**
	 *
	 * 增加/编辑逻辑
	 */
	public function doAdd()
	{
		$data = array();
		$data = $this->input->post();
		$this->load->model('OA_Hospitaladvice');
		if(isset($data['advice_id'])&&is_numeric($data['advice_id'])){
			if(checkRight('hospitaladvice_add') === FALSE && checkRight('hospitaladvice_follow') === FALSE && checkRight('hospitaladvice_appoint') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			if(isset($data['appointed'])&&$data['appointed']){
			    $data['advice_status'] = 2;
			    if($data['ap']==1){
			    	$savedata['advice_id'] = $data['advice_id'];
				    $savedata['appointed'] = $data['appointed'];
				    $savedata['advice_status'] = $data['advice_status'];
			    	$this->OA_Hospitaladvice->update($savedata);
			    	redirect(formatUrl('hospitaladvice/advice_list'));
			    }
			}
			if(isset($data['feedback_content'])){
				$savedata['advice_id'] = $data['advice_id'];
				$savedata['feedback_content'] = $data['feedback_content'];
				$savedata['advice_status'] = $data['advice_status'];
				$savedata['feedback_time'] = strtotime('now');
				$this->OA_Hospitaladvice->update($savedata);
			}else{
				$this->OA_Hospitaladvice->update($data);
			}
			redirect(formatUrl('hospitaladvice/advice_list'));
		}else{
			if(checkRight('hospitaladvice_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$msg = '';
			$data['added_time'] = strtotime('now');
			$data['added_by'] = $this->session->userdata('admin_id');
			if($this->OA_Hospitaladvice->add($data) === FALSE){
				$msg = '?msg='.urlencode('创建失败');
			}
			redirect(formatUrl('hospitaladvice/advice_list'.$msg));
		}
	}

	/**
	 *
	 * 删除
	 */
	public function doDel()
	{
		$data = array();
		if(checkRight('hospitaladvice_del') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$id = $this->input->get('id');
		//删除客服问题
		$this->load->model('OA_Customerservice');
		$this->OA_Customerservice->del($id);
		redirect(formatUrl('customerservice/record'));
	}

}