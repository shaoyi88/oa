<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  签约管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('order/index')}">订单管理</a> <span class="c-gray en">&gt;</span> 指派护工</nav>
<div class="pd-20">
	{if empty($workerList)}
		暂无可指派护工
	{else}
	<form class="Huiform" id="form-role-add" action="{formatUrl('order/doSetWorker')}" method="post">
		<input type="hidden" name="order_id" id="order_id" value="{$orderInfo['order_id']}" />
		<input type="hidden" name="start_time" id="start_time" value="{$orderInfo['order_start_time']}" />
		<table class="table table-border table-bordered table-bg">
      		<tbody>
        		<tr>
          		     <th class="text-r" width="150px">*护工：</th>
          		     <td>
          		     	{if $isMult}
          		     		{foreach $workerList as $item}
          		     		<input type="checkbox" name="worker_id[]" value="{$item['worker_id']}" nullmsg="护工不能为空！" datatype="*">&nbsp;{$item['worker_name']}&nbsp;&nbsp;&nbsp;&nbsp;
          		     		{/foreach}
          		     	{else}
          		     	<select style="width:30%" class="select" name="worker_id[]" nullmsg="护工不能为空！" datatype="*">
          		     		<option value="">请选择护工</option>	
          		     		{foreach $workerList as $item}
          		     		<option value="{$item['worker_id']}">{$item['worker_name']}</option>	
          		     		{/foreach}
          		     	</select>
          		     	{/if}
          		     </td>
          		</tr>   
        		<tr>
        			<th></th>
      				<td colspan="2">
      					<button type="submit" class="btn btn-success radius"><i class="icon-ok"></i>确定</button>
      				</td>
      		</tr>
        	</tbody>
        </table>
	</form>
	{/if}
</div>
<script type="text/javascript" src="/public/oa_admin/js/order.js"></script>