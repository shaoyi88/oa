{if !$hideTitle}
<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  签约管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('order/index')}">订单管理</a> <span class="c-gray en">&gt;</span> 订单详情</nav>
{/if}
{if isset($userInfo['user_name'])}
<div class="pd-10">
	<table class="table table-border table-bordered table-hover table-bg">
		<thead>
      		<tr class="text-c">
      			<th colspan="5">用户信息</th>
      		</tr>	
      		<tr class="text-c">
      			<th>姓名</th>
      			<th>昵称</th> 
      			<th>微信</th>
        		<th>手机</th>
        		<th>性别</th>
      		</tr> 
    	</thead>
    	<tr>
        	<td class="text-c" width="20%">{$userInfo['user_name']}</td>
        	<td class="text-c" width="20%">{if $userInfo['user_nickname']}{$userInfo['user_nickname']}{else}暂无{/if}</td>
        	<td class="text-c" width="20%">{if $userInfo['wechat_openid'] != ''}已绑定{else}未绑定{/if}</td>
        	<td class="text-c" width="20%">{$userInfo['user_phone']}</td>
        	<td class="text-c" width="20%">{$sexInfo[$userInfo['user_sex']]}</td>
        </tr>
	</table>
</div>
{/if}
{if isset($customerInfo['customer_name'])}
<div class="pd-10">
	<table class="table table-border table-bordered table-hover table-bg">
		<thead>
      		<tr class="text-c">
      			<th colspan="5">客户信息</th>
      		</tr>	
      		<tr class="text-c">
      			<th>姓名</th>
      			<th>性别</th>
      			<th>年龄</th>
      			<th>身份证</th>
      			<th>常用语言</th>
      		</tr>
    	</thead>
    	<tr>
        	<td class="text-c" width="20%">{$customerInfo['customer_name']}</td>
        	<td class="text-c" width="20%">{$sexInfo[$customerInfo['customer_sex']]}</td>
        	<td class="text-c" width="20%">{$customerInfo['customer_age']}</td>
        	<td class="text-c" width="20%">{if $customerInfo['customer_card'] != ''}{$customerInfo['customer_card']}{else}暂无{/if}</td>
        	<td class="text-c" width="20%">{$customerInfo['customer_language']}</td>
        </tr>
    </table>
</div>
{/if}
{if !empty($workerList)}
<div class="pd-10">
	<table class="table table-border table-bordered table-hover table-bg">
		<thead>
      		<tr class="text-c">
      			<th colspan="9">护工信息</th>
      		</tr>
      		<tr class="text-c">
      			<th width="10%">姓名</th>
      			<th width="20%">医院科室</th> 
      			<th width="10%">手机</th>
        		<th width="10%">性别</th>
        		<th width="10%">年龄</th>
        		<th width="10%">工作经验</th>
        		<th width="10%">开始服务时间</th>
        		<th width="10%">结束服务时间</th>
        		<th width="10%">提成</th>
      		</tr> 
    	</thead>
    	{foreach $workerList as $item}
        	<td class="text-c">{$item['worker_name']}</td>
        	<td class="text-c">{$nInfo[$item['worker_hospital']]}&nbsp;&nbsp;{$nInfo[$item['worker_stationary']]}</td>
        	<td class="text-c">{$item['worker_phone']}</td>
        	<td class="text-c">{$sexInfo[$item['worker_sex']]}</td>
        	<td class="text-c">{$item['worker_age']}</td>
        	<td class="text-c">{$item['worker_experience']}</td>
        	<td class="text-c">{date('Y-m-d H:i:s', $item['start_time'])}</td>
        	<td class="text-c">{if $item['end_time']}{date('Y-m-d H:i:s', $item['start_time'])}{else}服务进行中{/if}</td>
        	<td class="text-c">{if $item['salary']}{$item['salary']}{else}未结算{/if}</td>
        {/foreach}
    </table>
</div>
{/if}
<div class="pd-10">
  <table class="table table-bg table-border table-bordered">
    <tbody>
      <thead>
      		<tr class="text-c">
      			<th colspan="11">订单信息</th>
      		</tr>	
      		<tr class="text-c">
      			<th width="10%">订单编号</th>
      			<th width="10%">服务类型</th>
      			<th width="10%">服务模式</th>
      			<th width="10%">收费</th>
      			<th width="10%">开始时间</th>
      			<th width="10%">结束时间</th>
      			<th width="10%">预收款</th>
      			<th width="10%">费用总额</th>
      			<th width="5%">订单状态</th>
      			<th width="5%">操作人</th>
      			<th width="10%">创建时间</th>
      		</tr>
      </thead>
      <tr>
        <td class="text-c">{$orderInfo['order_no']}</td>
        <td class="text-c">{$serviceTypeInfo[$orderInfo['service_type']]}</td>
        <td class="text-c">{$order_service_mode[$orderInfo['service_mode']][0]}</td>
        <td class="text-c">{$orderInfo['order_fee']}元/{$order_fee_unit[$orderInfo['order_fee_unit']]}</td>
        <td class="text-c">{date('Y-m-d H:i:s',$orderInfo['order_start_time'])}</td>
        <td class="text-c">{if $orderInfo['order_end_time']}{date('Y-m-d H:i:s',$orderInfo['order_end_time'])}{else}未结束{/if}</td>
        <td class="text-c">{if $orderInfo['order_advance_payment']}{$orderInfo['order_advance_payment']}元{else}暂无{/if}</td>
        <td class="text-c">{if $orderInfo['order_total_cost']}{$orderInfo['order_total_cost']}元{else}未结算{/if}</td>
        <td class="text-c">{$order_status[$orderInfo['order_status']]}</td>
        <td class="text-c">{$orderInfo['admin_name']}</td>
        <td class="text-c">{date('Y-m-d H:i:s',$orderInfo['add_time'])}</td>
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
      	<th width="40%">原内容</th>
        <th width="40%">修改项</th>
        <th width="10%">修改人</th>
        <th width="10%">修改时间</th>
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
