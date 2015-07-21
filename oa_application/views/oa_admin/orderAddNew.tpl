<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  签约管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('order/index')}">订单管理</a> <span class="c-gray en">&gt;</span> 新用户订单新增</nav>
<div class="pd-20">
	<form id="addNewForm" id="form-role-add" action="{formatUrl('order/doAddNew')}" method="post">
		<table class="table table-border table-bordered table-bg">
      		<tbody> 
      			<tr>
      				<th colspan="2" class="text-c" style="background-color: #f5fafe;">用户信息</th>
      			</tr>
      			<tr>
          		     <th class="text-r" width="80">*姓名：</th>
          			 <td><input name="user_name" type="text" class="input-text" id="user_name" nullmsg="姓名不能为空！" datatype="s"></td>
        		</tr>
      			<tr>
          		     <th class="text-r" width="80">*手机：</th>
          			 <td><input name="user_phone" type="text" class="input-text" id="user_phone" errormsg="请输入正确的手机号码！" nullmsg="手机不能为空！" datatype="m"></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">*性别：</th>
          			 <td>
          			 	<select class="select" id="user_sex" name="user_sex" nullmsg="性别不能为空！" datatype="*">
      						<option value="">请选择性别</option>
      						{foreach $sexInfo as $key => $item}
      						<option value="{$key}">
      						{$item}
      						</option>
      						{/foreach}
    					</select>
          			 </td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">*地区：</th>
          			 <td>
          			 	<select target="user_city" style="width:30%" class="select" id="user_province" name="user_province" nullmsg="省份不能为空！" datatype="*">
          			 		<option value="">请选择</option>	
          			 		{foreach $provinceInfo as $item}
      							<option value="{$item['area_id']}" >
      								{$item['area_name']}
      							</option>
      						{/foreach}
          			 	</select>
          			 	<select style="width:30%" class="select" id="user_city" name="user_city" nullmsg="市区不能为空！" datatype="*">
          			 		<option value="">请选择</option>	
          			 		{foreach $cityInfo as $item}
      							<option value="{$item['area_id']}">
      								{$item['area_name']}
      							</option>
      						{/foreach}
          			 	</select>
          			 </td>
        		</tr>
        		<tr>
      				<th colspan="2" class="text-c" style="background-color: #f5fafe;">客户信息</th>
      			</tr>
      			<tr>
          		     <th class="text-r" width="80">*姓名：</th>
          			 <td><input name="customer_name" type="text" class="input-text" id="customer_name" nullmsg="姓名不能为空！" datatype="s"></td>
        		</tr>
        		<tr>
      				<td class="text-r" width="80">*关系：</td>
      				<td><input name="relationship" type="text" class="input-text" id="relationship" value="" nullmsg="关系不能为空！" datatype="s"></td>
      			</tr>
        		<tr>
          		     <th class="text-r" width="80">*性别：</th>
          			 <td>
          			 	<select class="select" id="customer_sex" name="customer_sex" nullmsg="性别不能为空！" datatype="*">
      						<option value="">请选择性别</option>
      						{foreach $sexInfo as $key => $item}
      						<option value="{$key}">
      						{$item}
      						</option>
      						{/foreach}
    					</select>
          			 </td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">*年龄：</th>
          			 <td><input name="customer_age" type="text" class="input-text" id="customer_age" nullmsg="年龄不能为空！" datatype="n"></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">身份证：</th>
          			 <td><input ignore="ignore" name="customer_card" type="text" class="input-text" id="customer_card"></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">*常用语言：</th>
          			 <td>
          			 	{foreach $languageInfo as $item}
          			 		<p>
          			 			<input type="radio" name="customer_language" value="{$item}" class="customer_language">{$item}
          			 			&nbsp;&nbsp;{if $item == '其他'}<input style="width:50%" name="other_language" type="text" class="input-text" id="other_language">{/if}
          			 		</p>
          			 	{/foreach}
          			 </td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">*客户分组：</th>
          			 <td>
          			 	<select class="select" id="customer_type" name="customer_type" nullmsg="客户分组不能为空！" datatype="*">
      						<option value="">请选择客户分组</option>
      						{foreach $groupInfo as $key => $item}
      						<option value="{$key}">
      						{$item}
      						</option>
      						{/foreach}
    					</select>
          			 </td>
        		</tr>
        		<tr id="tr_customer_address" style="display:none">
          		     <th class="text-r" width="80">*家庭地址：</th>
          			 <td><input {if isset($info)&&$info['customer_type']==1}{else}ignore="ignore"{/if} name="customer_address" type="text" class="input-text" id="customer_address" value="{if isset($info)}{$info['customer_address']}{/if}" nullmsg="家庭地址不能为空！" datatype="s"></td>
        		</tr>
        		<tr id="tr_customer_hospital" style="display:none">
          		     <th class="text-r" width="80">*医院信息：</th>
          			 <td>
          			 	<p>
          			 		<strong>医院:&nbsp;&nbsp;</strong>
          			 		<select  target="customer_hospital_department" style="width:50%" class="select" id="customer_hospital" name="customer_hospital" nullmsg="医院不能为空！" datatype="*">
      							<option value="">请选择医院</option>
      							{foreach $hospitalInfo as $item}
      							<option value="{$item['wb_id']}">
      							{$item['stationary_name']}
      							</option>
      							{/foreach}
    						</select>
    					</p>
    					<p>
    						<strong>科室:&nbsp;&nbsp;</strong>
    						<select style="width:50%" class="select" id="customer_hospital_department" name="customer_hospital_department" nullmsg="科室不能为空！" datatype="s">
      							<option value="">请选择科室</option>
      							{foreach $departmentInfo as $item}
      							<option value="{$item['wb_id']}">
      							{$item['stationary_name']}
      							</option>
      							{/foreach}
    						</select>
    					</p>
    					<p>
    						<strong>床位:&nbsp;&nbsp;</strong>
    						<input nullmsg="床位不能为空！" datatype="s" style="width:50%" name="customer_bed_no" type="text" class="input-text" id="customer_bed_no">
    					</p>
          			 </td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">*服务分组：</th>
          			 <td>
          			 	<select class="select" id="customer_service_type" name="customer_service_type" nullmsg="服务分组不能为空！" datatype="*">
      						<option value="">请选择服务分组</option>
      						{foreach $serviceTypeInfo as $key => $item}
      						<option value="{$key}">
      						{$item}
      						</option>
      						{/foreach}
    					</select>
          			 </td>
        		</tr>
      			<tr>
      				<th colspan="2" class="text-c" style="background-color: #f5fafe;">订单信息</th>
      			</tr>  
          		<tr>
          		     <th class="text-r">*服务模式：</th>
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
          		     <th class="text-r">*收费标准：</th>
          		     <td>
          		     	<input style="width:200px" type="text" class="input-text" id="order_fee" name="order_fee" nullmsg="收费标准不能为空！" datatype="n">
          		     </td>
          		</tr>  
          		<tr>
          		     <th class="text-r">*时间单位：</th>
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
      				<th class="text-r">*开始时间：</th>
      			 	<td>
      			 		<input style="width:200px" name="order_start_time" type="text" class="input-text" id="order_start_time" nullmsg="开始时间不能为空！" datatype="*">
      			 	</td>
      			</tr>
        		<tr>
        			<th></th>
      				<td colspan="2">
      					<button id="submitAddOrder" type="submit" class="btn btn-success radius"><i class="icon-ok"></i>新增</button>
      				</td>
      		</tr>
        	</tbody>
        </table>
	</form>
</div>
<script type="text/template" id="areaTpl">
<option value="">请选择</option>	
<%#areaList%>
	<option value="<%area_id%>">
	<%area_name%>
	</option>
<%/areaList%>
</script>
<script type="text/template" id="departmentTpl">
<option value="">请选择科室</option>	
<%#departmentList%>
	<option value="<%wb_id%>">
	<%stationary_name%>
	</option>
<%/departmentList%>
</script>
<input type="hidden" id="getDepartmentUrl" value="{formatUrl('hospital/getDepartment')}"></input>
<input type="hidden" id="getAreasUrl" value="{formatUrl('areas/getAreas')}"></input>
<script type="text/javascript" src="/public/common/js/hogan-2.0.0.min.js"></script>
<script type="text/javascript" src="/public/common/js/date/WdatePicker.js"></script>
<script type="text/javascript" src="/public/oa_admin/js/order.js"></script>