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

$config['service'] = array(
    'appId' => 'wx86b3751ad43f4062',
    'secret' => 'f52a587fefed285df9244f310eee8a34',
);


$config['words'] = array(
    'welcome' => '欢迎来到E家照护[玫瑰]E家照护提供就医、养老等资讯。关注健康，关注E家照护[太阳]一家依，医院级的康复护理专家[拥抱]',
    );

$config['subcribe_menus'] = array(
//    array(
//        'name' => '一家依',
//        'type' => 'view',
//        'key' => 'http://www.ecare-easy.com/',
//        'buttons' => null,
//    ),
    array(
        'name' => '服务预约',
        'type' => 'null',
        'key' => 'null',
        'buttons' => array(
            array(
                'name' => '主页',
                'type' => 'view',
                'key' => 'http://subcribe.ecare-easy.com/Service/wechat/home_page',
                'buttons' => null,
            ),
            array(
                'name' => '一家依合伙人',
                'type' => 'view',
                'key' => 'http://subcribe.ecare-easy.com/partner/index/index',
                'buttons' => null,
            ),
            array(
                'name' => '月嫂服务',
                'type' => 'view',
                'key' => 'http://subcribe.ecare-easy.com/Service/wechat/babysitter_service',
                'buttons' => null,
            ),
            array(
                'name' => '医院陪护',
                'type' => 'view',
                'key' => 'http://subcribe.ecare-easy.com/Service/wechat/hospital_care',
                'buttons' => null,
            ),
            array(
                'name' => '居家照护',
                'type' => 'view',
                'key' => 'http://subcribe.ecare-easy.com/Service/wechat/home_care',
                'buttons' => null,
            ),


        )
    ),
    // array(
        // 'name' => '健康知识',
        // 'type' => 'view',
        // 'key' => 'http://subcribe.ecare-easy.com/health/index/index',
        // 'buttons' => null,
    // ),
	    array(
        'name' => '潮爸潮妈',
        'type' => 'view',
        'key' => 'http://subcribe.ecare-easy.com/health/activity/index',
        'buttons' => null,
    ),
    array(
        'name'      => '我',
        'type'      => null,
        'key'       => null,
        'buttons'   => array(
            array(
                'name'      => '个人中心',
                'type'      => 'view',
                'key'      => 'http://subcribe.ecare-easy.com/Service/wechat/new_user_center',
                'buttons'      => null,
            ),
//            array(
//                'name'      => '我的预约',
//                'type'      => 'view',
//                'key'      => 'http://subcribe.ecare-easy.com/Service/wechat/my_appointment',
//                'buttons'      => null,
//            ),
            array(
                'name'      => '我的预约',
                'type'      => 'click',
                'key'      => 'CUSTOMER_SERVICE',
                'buttons'      => null,
            ),
            array(
                'name'      => '服务查询',
                'type'      => 'view',
                'key'      => 'http://subcribe.ecare-easy.com/Service/wechat/new_my_service',
                'buttons'      => null,
            ),
            array(
                'name'      => '吐槽建议',
                'type'      => 'view',
                'key'      => 'http://subcribe.ecare-easy.com/Service/wechat/advice',
                'buttons'      => null,
            ),

            array(
                'name'      => '关于一家依',
                'type'      => 'view',
                'key'      => 'http://i.eqxiu.com/s/1h0fHmL3',
                'buttons'      => null,
            ),

        ),
    )
//    array(
//        'name' => '服务预约',
//        'type' => 'null',
//        'key' => 'null',
//        'buttons' => array(
//            array(
//                'name' => '月嫂',
//                'type' => 'view',
//                'key' => 'http://subcribe.ecare-easy.com/Service/wechat/service_detail?id=1',
//                'buttons' => null,
//            ),
//            array(
//                'name' => '医院陪护',
//                'type' => 'view',
//                'key' => 'http://subcribe.ecare-easy.com/Service/wechat/service_detail?id=3',
//                'buttons' => null,
//            ),
//            array(
//                'name' => '居家照护',
//                'type' => 'view',
//                'key' => 'http://subcribe.ecare-easy.com/Service/wechat/service_detail?id=2',
//                'buttons' => null,
//            ),
//        )
//    ),
//    array(
//        'name' => '健康知识',
//        'type' => 'view',
//        'key' => 'http://subcribe.ecare-easy.com/knowledge/index/knowledge',
//        'buttons' => null,
//    ),
//    array(
//        'name'      => '我',
//        'type'      => null,
//        'key'       => null,
//        'buttons'   => array(
//            array(
//                'name'      => '个人中心',
//                'type'      => 'view',
//                'key'      => 'http://subcribe.ecare-easy.com/Service/wechat/user_center',
//                'buttons'      => null,
//            ),
//            array(
//                'name'      => '我的预约',
//                'type'      => 'view',
//                'key'      => 'http://subcribe.ecare-easy.com/Service/wechat/my_appointment',
//                'buttons'      => null,
//            ),
//            array(
//                'name'      => '服务查询',
//                'type'      => 'view',
//                'key'      => 'http://subcribe.ecare-easy.com/Service/wechat/my_signed_appointment.html',
//                'buttons'      => null,
//            ),
//            array(
//                'name'      => '吐槽建议',
//                'type'      => 'view',
//                'key'      => 'http://subcribe.ecare-easy.com/Service/wechat/advice.html',
//                'buttons'      => null,
//            ),
//            array(
//                'name'      => '关于一家依',
//                'type'      => 'view',
//                'key'      => 'http://subcribe.ecare-easy.com/Service/wechat/about_us',
//                'buttons'      => null,
//            ),
//
//        ),
//    )

);

$config['service_menus'] = array(
    array(
        'name' => '服务预约',
        'type' => 'null',
        'key' => 'null',
        'buttons' => array(
            array(
                'name' => '主页',
                'type' => 'view',
                'key' => 'http://subcribe.ecare-easy.com/Service/wechat/home_page',
                'buttons' => null,
            ),
            array(
                'name' => '一家依合伙人',
                'type' => 'view',
                'key' => 'http://subcribe.ecare-easy.com/partner/index/index',
                'buttons' => null,
            ),
            array(
                'name' => '月嫂服务',
                'type' => 'view',
                'key' => 'http://subcribe.ecare-easy.com/Service/wechat/babysitter_service',
                'buttons' => null,
            ),
            array(
                'name' => '医院陪护',
                'type' => 'view',
                'key' => 'http://subcribe.ecare-easy.com/Service/wechat/hospital_care',
                'buttons' => null,
            ),
            array(
                'name' => '居家照护',
                'type' => 'view',
                'key' => 'http://subcribe.ecare-easy.com/Service/wechat/home_care',
                'buttons' => null,
            ),

        )
    ),
    array(
        'name' => '健康知识',
        'type' => 'view',
        'key' => 'http://subcribe.ecare-easy.com/health/index/index',
        'buttons' => null,
    ),
    array(
        'name'      => '我',
        'type'      => null,
        'key'       => null,
        'buttons'   => array(
            array(
                'name'      => '个人中心',
                'type'      => 'view',
                'key'      => 'http://subcribe.ecare-easy.com/Service/wechat/new_user_center',
                'buttons'      => null,
            ),

            array(
                'name'      => '我的预约',
                'type'      => 'view',
                'key'      => 'http://subcribe.ecare-easy.com/Service/wechat/my_appointment',
                'buttons'      => null,
            ),
//            array(
//                'name'      => '服务查询',
//                'type'      => 'view',
//                'key'      => 'http://subcribe.ecare-easy.com/Service/wechat/new_my_service',
//                'buttons'      => null,
//            ),
            array(
                'name'      => '联系客服',
                'type'      => 'click',
                'key'      => 'CUSTOMER_SERVICE',
                'buttons'      => null,
            ),
            array(
                'name'      => '吐槽建议',
                'type'      => 'view',
                'key'      => 'http://subcribe.ecare-easy.com/Service/wechat/advice',
                'buttons'      => null,
            ),

            array(
                'name'      => '关于一家依',
                'type'      => 'view',
                'key'      => 'http://i.eqxiu.com/s/1h0fHmL3',
                'buttons'      => null,
            ),

        ),
    )

);
