<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  签约管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('order/index')}">订单管理</a> <span class="c-gray en">&gt;</span> 更换护工</nav>
<div class="pd-20">
	{if empty($workerList)}
		暂无可更换的护工
	{else}
	<form class="Huiform" id="form-role-add" action="{formatUrl('order/doChangeWorker')}" method="post">
		<input type="hidden" name="order_id" id="order_id" value="{$orderInfo['order_id']}" />
		<input type="hidden" name="customer_id" id="customer_id" value="{$orderInfo['customer_id']}" />
		<table class="table table-border table-bordered table-bg">
      		<tbody>
      			<tr>
          		     <th class="text-r" width="150px">*被更换护工：</th>
          		     <td>
          		     	<table class="table table-border table-bordered table-hover table-bg">
    						<thead>
      							<tr class="text-c">
      								<th></th>
        							<th>编号</th>
        							<th>姓名</th>
        							<th>医院科室</th>
        							<th>手机</th>
        							<th>性别</th>
        							<th>年龄</th>
        							<th>工作经验</th>
        							<th>工作状态</th>
      							</tr>
    						</thead>
    						<tbody>
    							{foreach $curWorkerList as $item}
    							 <tr class="text-c">
    							 	<td>
    							 		<input type="checkbox" name="cur_worker_id[]" value="{$item['worker_id']}" nullmsg="被更换护工不能为空！" datatype="*">
    							 	</td>
      								<td>{$item['worker_no']}</td>
        							<td>{$item['worker_name']}</td>
        							<td>{$nInfo[$item['worker_hospital']]}&nbsp;&nbsp;{$nInfo[$item['worker_stationary']]}</td>
        							<td>{$item['worker_phone']}</td>
        							<td>{$sexInfo[$item['worker_sex']]}</td>
        							<td>{$item['worker_age']}</td>
       			 					<td>{$item['worker_experience']}</td>
        							<td>{$wstatus[$item['worker_status']]}</td>
        						</tr>
        						{/foreach}
    						</tbody>
    					</table>
          		     </td>
          		</tr>   
        		<tr>
          		     <th class="text-r" width="150px">*更换护工：</th>
          		     <td>
          		     	<table class="table table-border table-bordered table-hover table-bg">
    						<thead>
      							<tr class="text-c">
      								<th></th>
        							<th>编号</th>
        							<th>姓名</th>
        							<th>医院科室</th>
        							<th>手机</th>
        							<th>性别</th>
        							<th>年龄</th>
        							<th>工作经验</th>
        							<th>工作状态</th>
      							</tr>
    						</thead>
    						<tbody>
    							{foreach $workerList as $item}
    							 <tr class="text-c">
    							 	<td>
    							 		{if $isMult}
    							 		<input type="checkbox" name="worker_id[]" value="{$item['worker_id']}" nullmsg="护工不能为空！" datatype="*">
    							 		{else}
    							 		<input type="radio" name="worker_id[]" value="{$item['worker_id']}" nullmsg="护工不能为空！" datatype="*">
    							 		{/if}
    							 	</td>
      								<td>{$item['worker_no']}</td>
        							<td>{$item['worker_name']}</td>
        							<td>{$nInfo[$item['worker_hospital']]}&nbsp;&nbsp;{$nInfo[$item['worker_stationary']]}</td>
        							<td>{$item['worker_phone']}</td>
        							<td>{$sexInfo[$item['worker_sex']]}</td>
        							<td>{$item['worker_age']}</td>
       			 					<td>{$item['worker_experience']}</td>
        							<td>{$wstatus[$item['worker_status']]}</td>
        						</tr>
        						{/foreach}
    						</tbody>
    					</table>
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