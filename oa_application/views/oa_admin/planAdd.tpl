<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  服务跟踪管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('nursing/planList')}">护理计划管理</a> <span class="c-gray en">&gt;</span> {$typeMsg}</nav>
<div class="pd-20">
	<form class="Huiform" id="form-role-add" action="{formatUrl('nursing/planDoAdd')}" method="post">
		{if isset($info)}
		<input name="plan_id" type="hidden" value="{$info['plan_id']}">
		{else}
		<input name="customer_id" id="customer_id" type="hidden" value="">
		<input name="worker_id" id="worker_id" type="hidden" value="">
		<input name="order_id" id="order_id" type="hidden" value="">
		{/if}
		<table class="table table-border table-bordered table-bg">
      		<tbody>
      			<tr>
          		     <th class="text-r" width="200">{if !isset($info)}*{/if}客户名字:</th>
          			 <td>
          			 	{if isset($info)}
          			 		{$info['customer_name']}
          			 	{else}
          			 	<input style="width:200px" type="text" class="input-text" id="customer_name" name="customer_name" value="" nullmsg="客户名字不能为空！" datatype="s" autocomplete="off">
      					&nbsp;&nbsp;&nbsp;&nbsp;提示：目前只可创建<font style="color:red">居家照护类型</font>且<font style="color:red">服务进行中</font>的客户
      					<div style="position:relative;">
      						<div class="auto-complete-result"></div>
      					</div>
      					{/if}
          			 </td>
        		</tr>
      			<tr>
          		     <th class="text-r" width="200">{if !isset($info)}*{/if}订单号：</th>
          			 <td>
          			 	{if isset($info)}
          			 		{$info['order_no']}
          			 	{else}
          			 	<input readonly="readonly" style="width:200px" type="text" class="input-text disabled" id="order_no" name="order_no" value="" nullmsg="订单号不能为空！" datatype="s" autocomplete="off">
          			 	{/if}
          			 </td>
        		</tr>
        		<tr>
          		     <th class="text-r">{if !isset($info)}*{/if}护工：</th>
          		     <td>
          		     	{if isset($info)}
          			 		{$info['worker_name']}
          			 	{else}
          			 	<input readonly="readonly" style="width:200px" type="text" class="input-text disabled" id="worker_name" name="worker_name" value="" nullmsg="护工不能为空！" datatype="s" autocomplete="off">
          		     	{/if}
          		     </td>
          		</tr>  
          		<tr>
          		     <th class="text-r">安全问题：</th>
          		     <td>
          		     <textarea cols="" rows="" class="textarea" name="safety_problem">{if isset($info)}{$info['safety_problem']}{/if}</textarea>
          		     </td>
          		</tr>  
          		<tr>
          		     <th class="text-r">能力锻炼：</th>
          		     <td>
          		     <textarea cols="" rows="" class="textarea" name="ability_training">{if isset($info)}{$info['ability_training']}{/if}</textarea>
          		     </td>
          		</tr> 
          		<tr>
          		     <th class="text-r">营养饮食：</th>
          		     <td>
          		     <textarea cols="" rows="" class="textarea" name="nutrition_diet">{if isset($info)}{$info['nutrition_diet']}{/if}</textarea>
          		     </td>
          		</tr> 
        		<tr>
        			<th></th>
      				<td colspan="2">
      					{if isset($info)}
      					<button id="submitAddPlan" type="submit" class="btn btn-success radius"><i class="icon-ok"></i>{$typeMsg}</button>
      					{else}
      					<button id="submitAddPlan" type="submit" class="btn btn-success radius disabled"><i class="icon-ok"></i>{$typeMsg}</button>
      					{/if}
      				</td>
      		</tr>
        	</tbody>
        </table>
	</form>
</div>
<script type="text/template" id="customerTpl">
<%#infoList%>
<ul>
	<li cid="<%customer_id%>" oid="<%order_id%>" wid="<%worker_id%>" order_no="<%order_no%>" worker_name="<%worker_name%>"><%customer_name%>(<%customer_age%>岁)</li>
</ul>
<%/infoList%>
</script>
<script type="text/javascript" src="/public/common/js/hogan-2.0.0.min.js"></script>
<input type="hidden" id="getInfoUrl" value="{formatUrl('nursing/getInfo')}"></input>
<script type="text/javascript" src="/public/oa_admin/js/nursing.js"></script>