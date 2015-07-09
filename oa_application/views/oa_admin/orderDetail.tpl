<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  签约管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('order/index')}">订单管理</a> <span class="c-gray en">&gt;</span> 订单详情</nav>
<div class="pd-20">
  <table class="table table-bg table-border table-bordered">
    <tbody>
      <tr>
        <th class="text-r" width="120">订单编号：</th>
        <td>{$orderInfo['order_no']}</td>
      </tr>
      <tr>
        <th class="text-r" width="120">用户：</th>
        <td>{$userInfo['user_name']}</td>
      </tr>
      <tr>
       <th class="text-r" width="120">客户：</th>
        <td>{$customerInfo['customer_name']}</td>
      </tr>
      <tr>
       <th class="text-r" width="120">护工：</th>
        <td>
        	{if empty($workerList)}
        		暂未指派
        	{else}
        		{foreach $workerList as $item}
        			<p>{$item['worker_name']}</p>
        		{/foreach}
        	{/if}
        </td>
      </tr>
      <tr>
        <th class="text-r" width="120">服务类型：</th>
        <td>{$serviceTypeInfo[$orderInfo['service_type']]}</td>
      </tr>
      <tr>
        <th class="text-r" width="120">服务模式：</th>
        <td>{$order_service_mode[$orderInfo['service_mode']][0]}</td>
      </tr>
      <tr>
      	<th class="text-r" width="120">收费：</th>
        <td>{$orderInfo['order_fee']}元/{$order_fee_unit[$orderInfo['order_fee_unit']]}</td>
      </tr>
      <tr>
      	<th class="text-r" width="120">开始时间：</th>
        <td>{date('Y-m-d H:i:s',$orderInfo['order_start_time'])}</td>
      </tr>
      <tr>
      	<th class="text-r" width="120">结束时间：</th>
        <td>{if $orderInfo['order_end_time']}{date('Y-m-d H:i:s',$orderInfo['order_end_time'])}{else}未结束{/if}</td>
      </tr>
      <tr>
      	<th class="text-r" width="120">预收款：</th>
        <td>{if $orderInfo['order_advance_payment']}{$orderInfo['order_advance_payment']}元{else}暂无{/if}</td>
      </tr>
      <tr>
      	<th class="text-r" width="120">费用总额：</th>
        <td>{if $orderInfo['order_total_cost']}{$orderInfo['order_total_cost']}元{else}未结算{/if}</td>
      </tr>
      <tr>
      	<th class="text-r" width="120">订单状态：</th>
        <td>{$order_status[$orderInfo['order_status']]}</td>
      </tr>
      <tr>
      	<th class="text-r" width="120">操作人：</th>
        <td>{$orderInfo['admin_name']}</td>
      </tr>
      <tr>
      	<th class="text-r" width="120">创建时间：</th>
        <td>{date('Y-m-d H:i:s',$orderInfo['add_time'])}</td>
      </tr>
    </tbody>
  </table>
</div>
{if !empty($historyInfo)}
<div class="pd-20">
<table class="table table-border table-bordered table-hover table-bg">
    <thead>
      <tr class="text-c">
      	<th colspan="4">订单修改历史</th>
      </tr>	
      <tr class="text-c">
      	<th>原内容</th>
        <th>修改项</th>
        <th>修改人</th>
        <th>修改时间</th>
      </tr>
    </thead>
    <tbody>
      {foreach $historyInfo as $item}
      <tr class="text-c">
        <td>{implode('</br>',json_decode($item['order_pre_info']))}</td>
        <td>{implode('</br>',json_decode($item['order_cur_info']))}</td>
        <td>{$item['admin_name']}</td>
        <td>{date('Y-m-d H:i:s',$item['add_time'])}</td>
      </tr>
      {/foreach}
    </tbody>
</table>
</div>
{/if}
