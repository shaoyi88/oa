<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 格式化url
 * @param unknown_type $uri
 */
function formatUrl($uri = '')
{
	$ci =& get_instance();
	return base_url().config_item('index_page').'/'.$ci->rtrDir.$uri;
}