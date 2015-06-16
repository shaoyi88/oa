<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends OA_Controller 
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}
	
	public function getCustomer()
	{
		if($this->input->get('key')){
			$key = $this->input->get('key');
		}
		$this->load->model('OA_Customer');
		$customerList = $this->OA_Customer->queryCustomerByKey($key);	
		if(empty($customerList)){			
			$this->send_json(array('status'=>0));
		}else{
			$this->send_json(array('status'=>1,'customerList'=>$customerList));
		}
	}
}