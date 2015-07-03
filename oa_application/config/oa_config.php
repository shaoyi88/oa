<?php
$config['menus'] = array(
	array(
		'module' => '系统管理',
		'menu' => array(
			array('组织部门管理', formatUrl('department/index'), 'department_list'),
			array('分组权限管理', formatUrl('role/index'), 'role_list'),
			array('系统用户管理', formatUrl('admin/index'), 'admin_list')
		),
		'right' => 'sys'
	),

	array(
		'module' => '资料管理',
		'menu' => array(
			array('用户信息管理', formatUrl('user/index'), 'user_list'),
			array('客户健康管理', formatUrl('customer/index'), 'customer_list'),
			array('客户统计分析', formatUrl('customer/stat'), 'customer_stat')
		),
		'right' => 'record'
	),

	array(
		'module' => '护工管理',
		'menu' => array(
			array('护工资料管理', formatUrl('worker/index'), 'worker_list'),
			array('护工服务统计', formatUrl('worker/stat'), 'worker_stat'),
			array('服务评价管理', formatUrl('worker/comment'), 'worker_comment'),
			array('驻点医院管理', formatUrl('hospital/index'), 'hospital_list'),
		),
		'right' => 'worker'
	),

	array(
		'module' => '签约管理',
		'menu' => array(
			array('订单管理', formatUrl('order/index'), 'order_list')
		),
		'right' => 'sign'
	),

	array(
		'module' => '服务跟踪管理',
		'menu' => array(
			array('护理计划管理', formatUrl('nursing/plan'), 'nursing_plan'),
			array('回访管理', formatUrl('nursing/return'), 'nursing_return')
		),
		'right' => 'service_trace'
	),

	array(
		'module' => '培训管理',
		'menu' => array(
			array('培训科目管理', formatUrl('train/index'), 'train_list'),
			array('培训流程管理', formatUrl('train/flow'), 'train_flow'),
			array('新晋员工管理', formatUrl('rookie/index'), 'rookie_list'),
			array('培训成绩管理', formatUrl('train/score'), 'train_score')
		),
		'right' => 'train'
	),

	array(
		'module' => '咨客管理',
		'menu' => array(
			array('客服人员管理', formatUrl('customerService/index'), 'customer_service_list'),
			array('工单记录管理', formatUrl('customerService/record'), 'customer_service_record'),
			array('工单跟踪管理', formatUrl('customerService/trace'), 'customer_service_trace'),
			array('问题统计分析', formatUrl('customerService/stat'), 'customer_service_stat')
		),
		'right' => 'customer_service'
	),

	array(
		'module' => '财务管理',
		'menu' => array(
			array('收款管理', formatUrl('finance/collect'), 'finance_collect'),
			array('对账管理', formatUrl('finance/balance'), 'finance_balance')
		),
		'right' => 'finance'
	),

    array(
        'module' => '预约服务管理',
        'menu' => array(
            array('预约单管理', formatUrl('service/appointment_management'), 'service_appointment_manager'),
            array('用户管理', formatUrl('service/user_management'), 'service_user_management')
        ),
        'right' => 'service'
    )
);

$config['rights'] = array(
	array(
		'module' => '系统管理',
		'roles' => array(
			array('组织部门列表', 'department_list'),
			array('组织部门增加', 'department_add'),
			array('组织部门编辑', 'department_edit'),
			array('组织部门删除', 'department_del', TRUE),
			array('分组权限列表', 'role_list'),
			array('分组权限增加', 'role_add'),
			array('分组权限编辑', 'role_edit'),
			array('分组权限删除', 'role_del', TRUE),
			array('系统用户列表', 'admin_list'),
			array('系统用户增加', 'admin_add'),
			array('系统用户编辑', 'admin_edit'),
			array('系统用户删除', 'admin_del')
		),
		'right' => 'sys'
	),
	array(
		'module' => '资料管理',
		'roles' => array(
			array('用户信息列表', 'user_list'),
			array('用户信息增加', 'user_add'),
			array('用户信息编辑', 'user_edit'),
			array('用户信息删除', 'user_del', TRUE),
			array('用户地址增加', 'user_address_add'),
			array('用户地址删除', 'user_address_del', TRUE),
			array('用户红包增加', 'user_coupon_add'),
			array('用户红包删除', 'user_coupon_del', TRUE),
			array('用户关注病人增加', 'user_follow_add'),
			array('用户关注病人删除', 'user_follow_del', TRUE),
			array('客户健康列表', 'customer_list'),
			array('客户健康增加', 'customer_add'),
			array('客户健康编辑', 'customer_edit'),
			array('客户健康删除', 'customer_del', TRUE),
			array('客户被关注增加', 'customer_follow_add'),
			array('客户被关注删除', 'customer_follow_del', TRUE),
			array('客户统计分析',  'customer_stat')
		),
		'right' => 'record'
	),

	array(
		'module' => '护工管理',
		'roles' => array(
			array('护工资料列表', 'worker_list'),
			array('护工资料增加', 'worker_add'),
			array('护工资料编辑', 'worker_edit'),
			array('护工资料删除', 'worker_del', TRUE),
			array('护工服务统计', 'worker_stat', TRUE),
			array('服务评价管理', 'worker_comment')
		),
		'right' => 'worker'
	),

	array(
		'module' => '签约管理',
		'roles' => array(
			array('预约管理', 'subscribe_list'),
			array('订单管理', 'order_list'),
			array('订单增加', 'order_add'),
			array('订单编辑', 'order_edit'),
			array('订单删除', 'order_del'),
			array('订单取消', 'order_cancel'),
			array('订单指派护工', 'order_set_worker'),
			array('订单更换护工', 'order_change_worker')
		),
		'right' => 'sign'
	),

	array(
		'module' => '服务跟踪管理',
		'roles' => array(
			array('护理计划管理', 'nursing_plan'),
			array('回访管理', 'nursing_return')
		),
		'right' => 'service_trace'
	),

	array(
		'module' => '培训管理',
		'roles' => array(
			array('培训科目管理', 'train_list'),
			array('培训流程管理', 'train_flow'),
			array('新晋员工管理', 'rookie_list'),
			array('培训成绩管理', 'train_score')
		),
		'right' => 'train'
	),

	array(
		'module' => '咨客管理',
		'roles' => array(
			array('客服人员管理', 'customer_service_list'),
			array('工单记录管理', 'customer_service_record'),
			array('工单跟踪管理', 'customer_service_trace'),
			array('问题统计分析', 'customer_service_stat')
		),
		'right' => 'customer_service'
	),

	array(
		'module' => '财务管理',
		'roles' => array(
			array('收款管理', 'finance_collect'),
			array('对账管理', 'finance_balance')
		),
		'right' => 'finance'
	),
    array(
        'module' => '预约服务管理',
        'roles' => array(
            array('预约单管理', 'service_appointment_management'),
            array('用户管理', 'service_user_management')
        ),
        'right' => 'service'
    )
);

$config['sex'] = array(
	'1' => '男',
	'2' => '女'
);

$config['customer_language'] = array(
	'广东话',
	'普通话',
	'英语',
	'其他'
);

$config['customer_group'] = array(
	'1' => '居家',
	'2' => '住院'
);

$config['customer_service_type'] = array(
	'1' => '居家照护',
	'2' => '医疗陪护',
	'3' => '陪诊',
	'4' => '月嫂'
);

$config['hobby_type'] = array(
	'烟',
	'酒',
	'其他'
);

$config['state_type'] = array(
	'清晰',
	'嗜睡',
	'烦躁',
	'昏迷',
	'其他'
);

$config['selfcare_ability'] = array(
	'独立完成',
	'部分协助',
	'完全依赖'
);

$config['service_level_1'] = array(
	'1' => '特级护理',
	'2' => '一级护理',
	'3' => '二级护理',
	'4' => '三级护理'
);

$config['service_level_2'] = array(
	'1' => '专业护士',
	'2' => '母婴护理员'
);

$config['marriage'] = array(
	'1' => '未婚',
	'2' => '已婚'
);

$config['education'] = array(
	'1' => '博士',
	'2' => '硕士',
	'3' => '本科',
	'4' => '大专',
	'5' => '中专',
	'6' => '高中',
	'7' => '初中',
	'8' => '小学',
	'9' => '不识字',
);

$config['worker_status'] = array(
	'1' => '上岗',
	'2' => '待工',
	'3' => '休假',
	'4' => '离职',
);

$config['order_service_mode'] = array(
	'1' => array('一对一', 1),
	'2' => array('一对多', 2),
	'3' => array('多对一', 1),
);

$config['worker_service_mode'] = array(
	'1' => '一对一',
	'2' => '一对多',
);

$config['order_fee_unit'] = array(
	'1' => '月',
	'2' => '天',
	'3' => '小时',
);

$config['order_status'] = array(
	'1' => '未确认', //支持查看，指派护工，取消，删除，编辑
	'2' => '进行中', //支持查看，编辑，更换护工
	'3' => '已完成', //支持查看
	'4' => '已取消'  //支持查看，删除
);