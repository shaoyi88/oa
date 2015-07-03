<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  签约管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('order/index')}">订单管理</a> <span class="c-gray en">&gt;</span> 新增</nav>
<div class="pd-20">
	<form class="Huiform" id="form-role-add" action="{formatUrl('order/doAdd')}" method="post">
		<input type="hidden" name="user_id" id="user_id" value="" />
		<table class="table table-border table-bordered table-bg">
      		<tbody>
      			<tr>
          		     <th class="text-r" width="200">用户ID/姓名/微信号/昵称/手机：</th>
          			 <td>
          			 	<input style="width:200px" type="text" class="input-text" id="user_key" value="" nullmsg="用户不能为空！" datatype="*" autocomplete="off">
      					<div style="position:relative;">
      						<div class="auto-complete-result"></div>
      					</div>
          			 </td>
        		</tr>
        		<tr>
          		     <th class="text-r">客户：</th>
          		     <td>
          		     	<select style="width:30%" class="select" id="customer_id" name="customer_id" nullmsg="客户不能为空！" datatype="*">
          		     		<option value="">请选择客户</option>	
          		     	</select>
          		     </td>
          		</tr>  
          		<tr>
          		     <th class="text-r">服务类型：</th>
          		     <td>
          		     	<select style="width:30%" class="select" id="service_type" name="service_type" nullmsg="服务类型不能为空！" datatype="*">
          		     		<option value="">请选择服务类型</option>	
          		     		{foreach $serviceTypeInfo as $key=>$item}
      							<option value="{$key}">
      								{$item}
      							</option>
      						{/foreach}
          		     	</select>
          		     </td>
          		</tr>  
          		<tr>
          		     <th class="text-r">服务模式：</th>
          		     <td>
          		     	<select style="width:30%" class="select" id="service_mode" name="service_mode" nullmsg="服务模式不能为空！" datatype="*">
          		     		<option value="">请选择服务模式</option>	
          		     		{foreach $order_service_mode as $key=>$item}
      							<option value="{$key}">
      								{$item[0]}
      							</option>
      						{/foreach}
          		     	</select>
          		     </td>
          		</tr>  
          		<tr>
          		     <th class="text-r">收费标准：</th>
          		     <td>
          		     	<input style="width:200px" type="text" class="input-text" id="order_fee" name="order_fee" value="" nullmsg="收费标准不能为空！" datatype="n">
          		     </td>
          		</tr>  
          		<tr>
          		     <th class="text-r">时间单位：</th>
          		     <td>
          		     	<select style="width:30%" class="select" id="order_fee_unit" name="order_fee_unit" nullmsg="时间单位不能为空！" datatype="*">
          		     		<option value="">请选择时间单位</option>	
          		     		{foreach $order_fee_unit as $key=>$item}
      							<option value="{$key}">
      								{$item}
      							</option>
      						{/foreach}
          		     	</select>
          		     </td>
          		</tr>  
          		<tr>
      				<th class="text-r">开始时间：</th>
      			 	<td><input style="width:200px" name="order_start_time" type="text" class="input-text" id="order_start_time" value="" nullmsg="开始时间不能为空！" datatype="*"></td>
      			</tr>
        		<tr>
        			<th></th>
      				<td colspan="2">
      					<button id="submitAddOrder" type="submit" class="btn btn-success radius disabled"><i class="icon-ok"></i>新增</button>
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
	<option value="<%customer_id%>">
	<%customer_name%>
	</option>
<%/customerList%>
</script>
<script type="text/javascript" src="/public/common/js/date/WdatePicker.js"></script>
<script type="text/javascript" src="/public/common/js/hogan-2.0.0.min.js"></script>
<input type="hidden" id="getUserUrl" value="{formatUrl('user/getUser')}"></input>
<input type="hidden" id="getFollowCustomerUrl" value="{formatUrl('follow/getFollowCustomer')}"></input>
<script type="text/javascript" src="/public/oa_admin/js/order.js"></script>