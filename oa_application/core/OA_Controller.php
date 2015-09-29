<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * 重写CI_Controller
 * 初始化，判断模板等逻辑
 *
 */
class OA_Controller extends CI_Controller
{
	const EXT              = VIEW_EXT;    // 模板后缀名     
	
	public $userId = '';                  // 用户id
	public $userName = '';                // 用户名
	public $userRights = '';              // 用户权限
	
	public $rtrClass;                     // 当前控制器class
	public $rtrMethod;                    // 当前控制器method
	public $rtrDir;                       // 当前控制器directory
	
	/**
	 * Override this behavior
	 * 控制器执行前函数
	 *
	 * @param string $method
	 */
	public function _remap($method, $params = array())
	{
		register_shutdown_function(array($this, 'handleFatalError'));
//		declare(encoding='UTF-8');
		mb_internal_encoding("UTF-8");
		
		$rtr =& load_class('Router', 'core');
		$this->rtrClass = $rtr->fetch_class();
		$this->rtrMethod = $rtr->fetch_method();
		$this->rtrDir = $rtr->fetch_directory();
		if(method_exists($this, $method)){
			$this->initialize();
			return call_user_func_array(array($this, $method), $params);
		}else{
			show_404();
		}
	}
	
	/**
	 * 处理致命错误
	 */
	function handleFatalError(){
		if ($e = error_get_last()){       
          $msg = $e['message'] . " in " . $e['file'] . ' line ' . $e['line'];
          log_message('error', 'PHP Fatal error: '.$msg);
		}
	}
	
	/**
	 * 初始化各种库
	 */
	protected function initialize()
	{
		//屏蔽缓存
		header('Content-Type: text/html; charset=utf-8');
		header('Expires: 0');
		header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Cache-Control: post-check=0, pre-check=0', FALSE);
		header('Pragma: no-cache');
		
		$this->load->library(array('Smarty_ext', 'session'));
		$this->load->helper(array('url'));	
		$this->config->load('oa_config');
		$this->load->database();

		$this->_getUserInfo();
	}
	
	private function _getUserInfo()
	{
		$this->userId = $this->session->userdata('admin_id');
		$this->userName = $this->session->userdata('admin_name');
		$this->userRights = $this->session->userdata('admin_rights');
		$this->hospitalId = $this->session->userdata('hospital_id');
	}
	
	/**
	 * Render view page
	 *
	 * @param string $template
	 * @param array $data
	 */
	protected function showView($template, $data = array())
	{
		$path = VIEW_DIR.$this->rtrDir.'/'.$template.'.'.self::EXT;
		if(@file_exists($path)){
			$this->smarty_ext->view($path, $this->rtrDir, $data);
		}else{
			log_message('error', 'can not find template file['.$path.']');
			show_error('can not find special template file');
		}
	}
	
	function  send_json($params)
	{
		$json = json_encode((array)$params);
		header('Status: 200 OK');
		echo $json;
		exit;
	}
}