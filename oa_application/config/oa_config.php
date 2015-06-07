<?php
$config['menus'] = array(
	array(
		'module' => '系统管理',
		'menu' => array(
			array('组织部门管理', formatUrl('department/index'), 'department_list'),
			array('系统用户管理', formatUrl('admin/index'), 'admin_list'),
			array('分组权限管理', formatUrl('group/index'), 'group_list')
		),
		'right' => 'sys'
	),
	
	array(
		'module' => '档案管理',
		'menu' => array(
			array('客户个人信息', formatUrl('crm/index'), 'customer_list'),
			array('护工资料管理', formatUrl('worker/index'), 'worker_list'),
			array('被看护人资料管理', formatUrl('nursed/index'), 'nursed_list')
		),
		'right' => 'recode'
	),
	
	array(
		'module' => '签约管理',
		'menu' => array(
			array('预约管理', formatUrl('crm/index'), 'subscribe_list'),
			array('订单管理', formatUrl('worker/index'), 'order_list')
		),
		'right' => 'sign'
	)
);