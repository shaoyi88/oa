<?php
$config['menus'] = array(
	array(
		'module' => '系统管理',
		'menu' => array(
			array('组织部门管理', formatUrl('department/index'), 'department_list'),
			array('系统用户管理', formatUrl('admin/index'), 'admin_list'),
			array('分组权限管理', formatUrl('role/index'), 'role_list')
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
			array('服务评价管理', formatUrl('worker/comment'), 'worker_comment')
		),
		'right' => 'worker'
	),
	
	array(
		'module' => '签约管理',
		'menu' => array(
			array('预约管理', formatUrl('subscribe/index'), 'subscribe_list'),
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
	)
);

$config['rights'] = array(
	'sys' => '系统管理'
);