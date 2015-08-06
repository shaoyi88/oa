<?php

define('WECHATSDK_PATH', THIRD_PATH.'wechat-master/');
define('APPID', 'wx86b3751ad43f4062');
define('APPSECRET', 'f52a587fefed285df9244f310eee8a34');
require_once WECHATSDK_PATH.'autoload.php';

use Overtrue\Wechat\Notice;   //微信模板信息

/**
 * 发送模版信息
 *$userId string     用户微信openid
 *$templateId string 微信模版id
 * $url              模版跳转链接，可以设置为空
 * $data array       模板数据，格式如下：
 *                   array("first" => "恭喜你购买成功！")
 *                   或
 *                   array("first" => array("value" => "恭喜你购买成功！", "color" => '#555555'))
 */
function templateSend($userId, $templateId, $url, $data)
{
	$notice = new Notice(APPID, APPSECRET);
    $res  = $notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($userId)->send();
    return $res;
}

