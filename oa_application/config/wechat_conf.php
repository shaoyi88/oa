<?php
/**
 * Created by PhpStorm.
 * User: cheaboar
 * Date: 2015/7/11
 * Time: 9:44
 */
$config['appId'] = 'wxb468b850fc76d278';
$config['token'] = 'Yijianyi';
$config['secret'] = 'b4843edb87fc8e3f0b1034bf946c5189';
$config['encodingAESKey'] = 'OvXZAh5akCf9oxrwgLbsu4a61gw4KmuVdGwZzxa1Cjx'; // 可选


$config['subcribe_menus'] = array(
    array(
        'name' => '服务',
        'type' => 'view',
        'key' => 'http://subcribe.ecare-easy.com/service/index/service_info',
        'buttons' => null
    ),
    array(
        'name' => '菜单',
        'key' => null,
        'type' => null,
        'buttons' => array(
            array(
                'name' => '服务',
                'type' => 'view',
                'key' => 'http://www.baidu.com',
                'buttons' => null
            ),
            array(
                'name' => '百度',
                'type' => 'view',
                'key' => 'http://www.baidu.com',
                'buttons' => null
            )

        )
    ),
    array(
        'name' => '菜单1',
        'key' => null,
        'type' => null,
        'buttons' => array(
            array(
                'name' => '服务1',
                'type' => 'view',
                'key' => 'http://www.baidu.com',
                'buttons' => null
            ),
            array(
                'name' => '百度1',
                'type' => 'view',
                'key' => 'http://www.baidu.com',
                'buttons' => null
            )

        )
    )
);

