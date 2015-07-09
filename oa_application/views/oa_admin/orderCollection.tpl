<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  签约管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('order/index')}">订单管理</a> <span class="c-gray en">&gt;</span> 收款</nav>
<div class="pd-20">
	<form class="Huiform" id="form-role-add" action="{formatUrl('order/doCollection')}" method="post">
		<input name="order_id" type="hidden" value="{$orderInfo['order_id']}">
		<input name="order_no" type="hidden" value="{$orderInfo['order_no']}">
		<input id="timeUnit" type="hidden" value="{$timeUnit}">
		<input id="order_fee" type="hidden" value="{$order_fee}">
		<input id="order_advance_payment" type="hidden" value="{$order_advance_payment}">
		<table class="table table-border table-bordered table-bg">
      		<tbody>
      			<tr>
          		     <th class="text-r" width="200">订单信息：</th>
          			 <td>
          			 	<table class="table table-border table-bordered table-bg">
          			 		<tbody>
          			 			<tr>
          			 				<th class="text-r" width="200">订单号：</th>
          			 				<td>{$orderInfo['order_no']}</td>
          			 			</tr>
          			 			<tr>
          			 				<th class="text-r" width="200">用户：</th>
          			 				<td>{$userInfo['user_name']}</td>
          			 			</tr>
          			 			<tr>
          			 				<th class="text-r" width="200">客户：</th>
        							<td>{$customerInfo['customer_name']}</td>
     	 						</tr>
          			 			<tr>
          			 				<th class="text-r" width="200">订单收费标准：</th>
          			 				<td>{$orderInfo['order_fee']}元/{$order_fee_unit[$orderInfo['order_fee_unit']]}</td>
          			 			</tr>
          			 			<tr>
          			 				<th class="text-r" width="200">订单开始时间：</th>
          			 				<td id="order_start_time">{date('Y-m-d H:i:s' ,$orderInfo['order_start_time'])}</td>
          			 			</tr>
          			 			<tr>
          			 				<th class="text-r" width="200">订单当前预付款：</th>
          			 				<td>{$order_advance_payment}元</td>
          			 			</tr>
          			 		</tbody>
          			 	</table>
          			 </td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="200">护工信息：</th>
          			 <td>
          			 	<table class="table table-border table-bordered table-bg">
          			 		<tbody>
          			 			<tr class="text-c">
          			 				<th>护工</th>
          			 				<th>开始服务时间</th>
          			 				<th>截止服务时间</th>
          			 			</tr>
          			 			{foreach $workerInfo as $worker}
          			 			<tr class="text-c worker">
          			 				<input type="hidden" start_time="{$worker['start_time']}" end_time="{$worker['end_time']}">
          			 				{if $worker['status'] == 1}
          			 				<input type="hidden" name="worker[]" value="{$worker['worker_id']}">
          			 				{/if}
          			 				<td>{$worker['worker_name']}</th>
          			 				<td>{date('Y-m-d H:i:s' ,$worker['start_time'])}</th>
          			 				<td>{if $worker['end_time']}{date('Y-m-d H:i:s' ,$worker['end_time'])}{else}服务中{/if}</th>
          			 			</tr>
          			 			{/foreach}
          			 		</tbody>
          			 	</table>
          			 </td>
        		</tr>
      			<tr>
          		     <th class="text-r" width="200">收款分类：</th>
          			 <td>
          			 	<select style="width:30%" class="select" id="collection_type" name="collection_type" nullmsg="收款分类不能为空！" datatype="*">
          		     		<option value="">请选择收款分类</option>	
          		     		{foreach $order_collection_type as $key=>$item}
          		     		<option value="{$key}">{$item}</option>	
          		     		{/foreach}
          		     	</select>
          			 </td>
        		</tr>
          		<tr class="payment_1" style="display:none">
          		     <th class="text-r">预收金额：</th>
          		     <td>
          		     	<input style="width:200px" type="text" class="input-text" id="collection_amount_1" name="collection_amount_1" value="" nullmsg="金额不能为空！" errormsg="金额必须为整数" datatype="collection_amount">元
          		     </td>
          		</tr>  
          		<tr class="payment_2" style="display:none">
          		     <th class="text-r">订单截至时间：</th>
          		     <td>
          		     	<input style="width:200px" name="order_end_time" type="text" class="input-text" id="order_end_time" value="" nullmsg="截至时间不能为空！" datatype="*">
          		     </td>
          		</tr> 
          		<tr class="payment_2" style="display:none">
          		     <th class="text-r">结算金额：</th>
          		     <td>
          		     	<input style="width:200px" type="text" class="input-text" id="collection_amount_2" name="collection_amount_2" value="" nullmsg="金额不能为空！" errormsg="金额必须为整数" datatype="collection_amount">元
          		     </td>
          		</tr> 
        		<tr>
        			<th></th>
      				<td colspan="2">
      					<button type="submit" class="btn btn-success radius"><i class="icon-ok"></i>确认</button>
      				</td>
      		</tr>
        	</tbody>
        </table>
	</form>
</div>
<script type="text/javascript" src="/public/common/js/date/WdatePicker.js"></script>
<script type="text/javascript" src="/public/oa_admin/js/order.js"></script>