<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  签约管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('order/index')}">订单管理</a> <span class="c-gray en">&gt;</span> {$typeMsg}</nav>
<div class="pd-20">
	<form class="Huiform" id="form-role-add" action="{formatUrl('order/doAdd')}" method="post">
		{if isset($info)}
		<input name="order_id" type="hidden" value="{$info['order_id']}">
		{else}
		<input type="hidden" name="user_id" id="user_id" value="" />
		<input type="hidden" name="service_type" id="service_type" value="" />
		{/if}
		<table class="table table-border table-bordered table-bg">
      		<tbody>
      			{if isset($info)}
      			<tr>
          		     <th class="text-r" width="200">订单号：</th>
          			 <td>
          			 	{$info['order_no']}
          			 </td>
        		</tr>
      			{/if}
      			<tr>
          		     <th class="text-r" width="200">{if !isset($userInfo)}*{/if}用户ID/姓名/微信号/昵称/手机：</th>
          			 <td>
          			 	{if isset($userInfo)}
          			 		{$userInfo['user_name']}
          			 	{else}
          			 	<input style="width:200px" type="text" class="input-text" id="user_key" value="" nullmsg="用户不能为空！" datatype="*" autocomplete="off">
          			 	<span style="margin-left:10px;">用户不存在？请点击<a style="color:red" href="{formatUrl('order/addNew')}">这里</a></span>
      					<div style="position:relative;">
      						<div class="auto-complete-result"></div>
      					</div>
      					{/if}
          			 </td>
        		</tr>
        		<tr>
          		     <th class="text-r">{if !isset($userInfo)}*{/if}客户：</th>
          		     <td>
          		     	{if isset($customerInfo)}
          			 		{$customerInfo['customer_name']}
          			 	{else}
          		     	<select style="width:30%" class="select" id="customer_id" name="customer_id" nullmsg="客户不能为空！" datatype="*">
          		     		<option value="">请选择客户</option>	
          		     	</select>
          		     	{/if}
          		     </td>
          		</tr>  
          		<tr>
          		     <th class="text-r">{if !isset($info) || $info['order_status'] == 1}*{/if}服务模式：</th>
          		     <td>  
          		     	{if isset($info) && $info['order_status'] != 1}
          		     		{$order_service_mode[$info['service_mode']][0]}
          		     	{else}
          		     	<select style="width:30%" class="select" id="service_mode" name="service_mode" nullmsg="服务模式不能为空！" datatype="*">
          		     		<option value="">请选择服务模式</option>	
          		     		{foreach $order_service_mode as $key=>$item}
      							<option value="{$key}" {if isset($info) && $info['order_status'] == $key}selected{/if}>
      								{$item[0]}
      							</option>
      						{/foreach}
          		     	</select>
          		     	{/if}
          		     </td>
          		</tr>  
          		<tr>
          		     <th class="text-r">*收费标准：</th>
          		     <td>
          		     	<input style="width:200px" type="text" class="input-text" id="order_fee" name="order_fee" value="{if isset($info)}{$info['order_fee']}{/if}" nullmsg="收费标准不能为空！" datatype="n">
          		     </td>
          		</tr>  
          		<tr>
          		     <th class="text-r">*时间单位：</th>
          		     <td>
          		     	<select style="width:30%" class="select" id="order_fee_unit" name="order_fee_unit" nullmsg="时间单位不能为空！" datatype="*">
          		     		<option value="">请选择时间单位</option>	
          		     		{foreach $order_fee_unit as $key=>$item}
      							<option value="{$key}" {if isset($info) && $info['order_fee_unit'] == $key}selected{/if}>
      								{$item}
      							</option>
      						{/foreach}
          		     	</select>
          		     </td>
          		</tr>  
          		<tr>
      				<th class="text-r">{if !isset($info) || $info['order_status'] == 1}*{/if}开始时间：</th>
      			 	<td>
      			 		{if isset($info) && $info['order_status'] != 1}
          		     		{$order_start_time}
          		     	{else}
      			 		<input style="width:200px" name="order_start_time" type="text" class="input-text" id="order_start_time" value="{if isset($info)}{$order_start_time}{/if}" nullmsg="开始时间不能为空！" datatype="*">
      			 		{/if}
      			 	</td>
      			</tr>
        		<tr>
        			<th></th>
      				<td colspan="2">
      					{if isset($info)}
      					<button id="submitAddOrder" type="submit" class="btn btn-success radius"><i class="icon-ok"></i>{$typeMsg}</button>
      					{else}
      					<button id="submitAddOrder" type="submit" class="btn btn-success radius disabled"><i class="icon-ok"></i>{$typeMsg}</button>
      					{/if}
      				</td>
      		</tr>
        	</tbody>
        </table>
	</form>
</div>
<script type="text/template" id="userTpl">
<ul>
<%#userList%>
<li uid="<%user_id%>"><%user_name%>_<%user_phone%></li>
<%/userList%>
</ul>
</script>
<script type="text/template" id="customerTpl">
<option value="">请选择客户</option>	
<%#customerList%>
	<option value="<%customer_id%>" type="<%customer_service_type%>">
	<%customer_name%>
	</option>
<%/customerList%>
</script>
<script type="text/javascript" src="/public/common/js/date/WdatePicker.js"></script>
<script type="text/javascript" src="/public/common/js/hogan-2.0.0.min.js"></script>
<input type="hidden" id="getUserUrl" value="{formatUrl('user/getUser')}"></input>
<input type="hidden" id="getFollowCustomerUrl" value="{formatUrl('follow/getFollowCustomer')}"></input>
<script type="text/javascript" src="/public/oa_admin/js/order.js"></script>