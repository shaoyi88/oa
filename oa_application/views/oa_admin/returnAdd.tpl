<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  服务跟踪管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('nursing/planList')}">护理计划管理</a> <span class="c-gray en">&gt;</span> 增加回访计划</nav>
<div class="pd-20">
	<form class="Huiform" id="form-role-add" action="{formatUrl('nursing/returnDoAdd')}" method="post">
		<input name="plan_id" id="plan_id" type="hidden" value="{$plan_id}">
		<input name="customer_id" id="customer_id" type="hidden" value="{$customer_id}">
		<input name="customer_name" id="customer_name" type="hidden" value="{$customer_name}">
		<input name="customer_address" id="customer_address" type="hidden" value="{$customer_address}">	
		<input name="executive_admin_name" id="executive_admin_name" type="hidden" value="">	
		<table class="table table-border table-bordered table-bg">
      		<tbody>
      			<tr>
          		     <th class="text-r" width="200">回访时间:</th>
          			 <td>
          			 	<input style="width:200px" name="return_time" type="text" class="input-text" id="return_time" value="" nullmsg="回访时间不能为空！" datatype="*">
          			 </td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="200">回访人:</th>
          			 <td>
          			 	<select style="width:30%" class="select" id="executive_admin_id" name="executive_admin_id" nullmsg="回访人不能为空！" datatype="*">
          		     		<option value="">请选择回访人</option>	
          		     		{foreach $adminList as $item}
      							<option value="{$item['admin_id']}">
      								{$item['admin_name']}
      							</option>
      						{/foreach}
          		     	</select>
          			 </td>
        		</tr>
        		<tr>
        			<th></th>
      				<td colspan="2">
      					<button id="submitAddPlan" type="submit" class="btn btn-success radius"><i class="icon-ok"></i>新增</button>
      				</td>
      		</tr>
        	</tbody>
        </table>
	</form>
</div>
<script type="text/javascript" src="/public/common/js/date/WdatePicker.js"></script>
<script type="text/javascript" src="/public/oa_admin/js/nursing.js"></script>