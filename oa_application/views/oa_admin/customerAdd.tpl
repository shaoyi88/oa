<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  资料管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('customer/index')}">客户健康管理</a> <span class="c-gray en">&gt;</span> {$typeMsg}</nav>
<div class="pd-20">
	<form class="Huiform" id="addNewForm" action="{formatUrl('customer/doAdd')}" method="post">
		{if isset($info)}
		<input name="customer_id" type="hidden" value="{$info['customer_id']}">
		{/if}
		<table class="table table-border table-bordered table-bg">
      		<tbody>
      			<tr>
          		     <th class="text-r" width="80">*姓名：</th>
          			 <td><input name="customer_name" type="text" class="input-text" id="customer_name" value="{if isset($info)}{$info['customer_name']}{/if}" nullmsg="姓名不能为空！" datatype="s"></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">*性别：</th>
          			 <td>
          			 	{foreach $sexInfo as $key => $item}
          			 	<input type="radio" name="customer_sex" value="{$key}" nullmsg="性别不能为空！" datatype="*"
          			 		{if isset($info) && $info['customer_sex'] == $key}checked{/if}>{$item}&nbsp;&nbsp;
          			 	{/foreach}			
          			 </td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">*年龄：</th>
          			 <td><input name="customer_age" type="text" class="input-text" id="customer_age" value="{if isset($info)}{$info['customer_age']}{/if}" nullmsg="年龄不能为空！" datatype="n"></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">身份证：</th>
          			 <td><input ignore="ignore" name="customer_card" type="text" class="input-text" id="customer_card" value="{if isset($info)}{$info['customer_card']}{/if}"></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">*常用语言：</th>
          			 <td>
          			 	{foreach $languageInfo as $item}
          			 			<input type="radio" name="customer_language" value="{$item}" class="customer_language"
          			 				{if isset($info) && ((!in_array($info['customer_language'], $languageInfo) && $item == '其他') || $info['customer_language'] == $item)}checked{/if}>{$item}
          			 			&nbsp;&nbsp;{if $item == '其他'}<input style="width:50%" name="other_language" type="text" class="input-text" id="other_language" value="{if isset($info)&&!in_array($info['customer_language'], $languageInfo)}{$info['customer_language']}{/if}">{/if}
          			 	{/foreach}
          			 </td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">*客户分组：</th>
          			 <td>
          			 	{foreach $groupInfo as $key => $item}
          			 	<input type="radio" name="customer_type" class="customer_type" value="{$key}" nullmsg="客户分组不能为空！" datatype="*"
          			 		{if isset($info) && $info['customer_type'] == $key}checked{/if}>{$item}&nbsp;&nbsp;
          			 	{/foreach}
          			 	</td>
        		</tr>
        		<tr id="tr_customer_address" {if isset($info)&&$info['customer_type']==1}{else}style="display:none"{/if}>
          		     <th class="text-r" width="80">*家庭地址：</th>
          			 <td><input {if isset($info)&&$info['customer_type']==1}{else}ignore="ignore"{/if} name="customer_address" type="text" class="input-text" id="customer_address" value="{if isset($info)}{$info['customer_address']}{/if}" nullmsg="家庭地址不能为空！" datatype="s"></td>
        		</tr>
        		<tr id="tr_customer_hospital" {if isset($info)&&$info['customer_type']==2}{else}style="display:none"{/if}>
          		     <th class="text-r" width="80">*医院信息：</th>
          			 <td>
          			 	<p>
          			 		<strong>医院:&nbsp;&nbsp;</strong>
          			 		{if isset($curHospital)}
          			 		<select style="width:50%" class="select" id="customer_hospital" name="customer_hospital">
      							<option value="{$curHospital}">
      								{$curHospitalName}
      							</option>
    						</select>
          			 		{else}
          			 		<select  target="customer_hospital_department" {if isset($info)&&$info['customer_type']==2}{else}ignore="ignore"{/if} style="width:50%" class="select" id="customer_hospital" name="customer_hospital" nullmsg="医院不能为空！" datatype="*">
      							<option value="">请选择医院</option>
      							{foreach $hospitalInfo as $item}
      							<option value="{$item['wb_id']}" {if isset($info) && $info['customer_hospital'] == $item['wb_id']}selected{/if}>
      							{$item['stationary_name']}
      							</option>
      							{/foreach}
    						</select>
    						{/if}
    					</p>
    					<p>
    						<strong>科室:&nbsp;&nbsp;</strong>
    						{if isset($curNInfo)}
    						<select {if isset($info)&&$info['customer_type']==2}{else}ignore="ignore"{/if} style="width:50%" class="select" id="customer_hospital_department" name="customer_hospital_department" nullmsg="科室不能为空！" datatype="s">
      							<option value="">请选择科室</option>
      							{foreach $curNInfo as $item}
      							<option value="{$item['wb_id']}" {if isset($info) && $info['customer_hospital_department'] == $item['wb_id']}selected{/if}>
      							{$item['stationary_name']}
      							</option>
      							{/foreach}
    						</select>
    						{else}
    						<select {if isset($info)&&$info['customer_type']==2}{else}ignore="ignore"{/if} style="width:50%" class="select" id="customer_hospital_department" name="customer_hospital_department" nullmsg="科室不能为空！" datatype="s">
      							<option value="">请选择科室</option>
      							{foreach $departmentInfo as $item}
      							<option value="{$item['wb_id']}" {if isset($info) && $info['customer_hospital_department'] == $item['wb_id']}selected{/if}>
      							{$item['stationary_name']}
      							</option>
      							{/foreach}
    						</select>
    						{/if}
    					</p>
    					<p>
    						<strong>床位:&nbsp;&nbsp;</strong>
    						<input {if isset($info)&&$info['customer_type']==2}{else}ignore="ignore"{/if} nullmsg="床位不能为空！" datatype="s" style="width:50%" name="customer_bed_no" type="text" class="input-text" id="customer_bed_no" value="{if isset($info)}{$info['customer_bed_no']}{/if}">
    					</p>
          			 </td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">*服务分组：</th>
          			 <td>
          			 	{foreach $serviceTypeInfo as $key => $item}
          			 	<input type="radio" name="customer_service_type" class="customer_service_type" value="{$key}" nullmsg="服务分组不能为空！" datatype="*"
          			 		{if isset($info) && $info['customer_service_type'] == $key}checked{/if}>{$item}&nbsp;&nbsp;
          			 	{/foreach}
          			 </td>
        		</tr>
        		<tr class="tr_service_info_1" {if isset($info)&&$info['customer_service_type']!=4}{else}style="display:none"{/if}>
        			<th class="text-r" width="80">个人评估：</th>
        			<td>
        				<table class="table table-bg table-border table-bordered">
        					<tbody>
        						<tr>
          		     				<th class="text-r" width="100">病情：</th>
          			 				<td><input name="customer_illness" type="text" class="input-text" id="customer_illness" value="{if isset($info)}{$info['customer_illness']}{/if}"></td>
        						</tr>
        						<tr>
          		     				<th class="text-r" width="80">过敏药物或食品：</th>
          			 				<td><input name="customer_allergy" type="text" class="input-text" id="customer_allergy" value="{if isset($info)}{$info['customer_allergy']}{/if}"></td>
        						</tr>
        						<tr>
          		     				<th class="text-r" width="80">个人特殊嗜好：</th>
          			 				<td>
          			 				{foreach $hobbyTypeInfo as $item}
          			 				<input type="radio" name="customer_hobby" value="{$item}" class="customer_hobby"
          			 					{if isset($info) && $info['customer_hobby'] && ((!in_array($info['customer_hobby'], $hobbyTypeInfo) && $item == '其他') || $info['customer_hobby'] == $item)}checked{/if}>{$item}
          			 				&nbsp;&nbsp;{if $item == '其他'}<input style="width:50%" name="other_hobby" type="text" class="input-text" id="other_hobby" value="{if isset($info)&&!in_array($info['customer_hobby'], $hobbyTypeInfo)}{$info['customer_hobby']}{/if}">{/if}
          			 				{/foreach}
          			 				</td>
        						</tr>
        						<tr>
          		     				<th class="text-r" width="80">家庭遗传病史：</th>
          							 <td><input name="customer_genetic" type="text" class="input-text" id="customer_genetic" value="{if isset($info)}{$info['customer_genetic']}{/if}"></td>
        						</tr>
        						<tr>
          		     				<th class="text-r" width="80">大小便情况：</th>
          			 				<td><input name="customer_defecate_piss" type="text" class="input-text" id="customer_defecate_piss" value="{if isset($info)}{$info['customer_defecate_piss']}{/if}"></td>
        						</tr>
        						<tr>
          		     				<th class="text-r" width="80">意识状态：</th>
          			 				<td>
          			 				{foreach $stateType as $item}
          			 				<input type="radio" name="customer_state" value="{$item}" class="customer_state"
          			 				{if isset($info) && $info['customer_state'] && ((!in_array($info['customer_state'], $stateType) && $item == '其他') || $info['customer_state'] == $item)}checked{/if}>{$item}
          			 				&nbsp;&nbsp;{if $item == '其他'}<input style="width:50%" name="other_state" type="text" class="input-text" id="other_state" value="{if isset($info)&&!in_array($info['customer_state'], $stateType)}{$info['customer_state']}{/if}">{/if}
          			 				{/foreach}
          			 				</td>
        						</tr>
        						<tr class="tr_service_info_1" {if isset($info)&&$info['customer_service_type']!=4}{else}style="display:none"{/if}>
          		     				<th class="text-r" width="80">自理能力：</th>
          							<td>
          							{foreach $selfcareAbilityType as $key=>$item}
          							<input type="radio" name="customer_selfcare_ability" value="{$key}"
          			 					{if isset($info) && $info['customer_selfcare_ability'] == $key}checked{/if}>{$item}&nbsp;&nbsp;
          							{/foreach}
          			 				</td>
        						</tr>
        						<tr>
          		     				<th class="text-r" width="80">风险因素：</th>
          			 				<td>
          			 					<p>
    										<strong>心脑血管:&nbsp;&nbsp;</strong>
    										<input style="width:50%" name="customer_risk_xnxg" type="text" class="input-text" id="customer_risk_xnxg" value="{if isset($info)}{$info['customer_risk_xnxg']}{/if}">
    									</p>
    									<p>
    										<strong>呼吸系统:&nbsp;&nbsp;</strong>
    										<input style="width:50%" name="customer_risk_hxxt" type="text" class="input-text" id="customer_risk_hxxt" value="{if isset($info)}{$info['customer_risk_hxxt']}{/if}">
    									</p>
    									<p>
    										<strong>消化系统:&nbsp;&nbsp;</strong>
    										<input style="width:50%" name="customer_risk_xhxt" type="text" class="input-text" id="customer_risk_xhxt" value="{if isset($info)}{$info['customer_risk_xhxt']}{/if}">
    									</p>
    									<p>
    										<strong>神经系统:&nbsp;&nbsp;</strong>
    										<input style="width:50%" name="customer_risk_sjxt" type="text" class="input-text" id="customer_risk_sjxt" value="{if isset($info)}{$info['customer_risk_sjxt']}{/if}">
    									</p>
    									<p>
    										<strong>其他问题:&nbsp;&nbsp;</strong>
    										<input style="width:50%" name="customer_risk_other" type="text" class="input-text" id="customer_risk_other" value="{if isset($info)}{$info['customer_risk_other']}{/if}">
    									</p>
          			 				</td>
        						</tr>
        						<tr>
          		     				<th class="text-r" width="80">服务级别：</th>
          			 				<td>
          			 				{foreach $serviceLevel1 as $key => $item}
          			 				<input type="radio" name="customer_service_level1" value="{$key}"
          			 					{if isset($info) && $info['customer_service_type'] != 4 && $info['customer_service_level'] == $key}checked{/if}>{$item}&nbsp;&nbsp;
          			 				{/foreach}
          			 				</td>
        						</tr>
        					</tbody>
        				</table>
        			</td>
        		</tr>
        		<tr class="tr_service_info_2" {if isset($info)&&$info['customer_service_type']==4}{else}style="display:none"{/if}>
        			<th class="text-r" width="80">个人评估：</th>
        			<td>
        				<table class="table table-bg table-border table-bordered">
        					<tbody>
        						<tr>
          		     				<th class="text-r" width="80">怀孕周数：</th>
          							 <td><input name="customer_pregnant_week" type="text" class="input-text" id="customer_pregnant_week" value="{if isset($info) && $info['customer_pregnant_week']}{$info['customer_pregnant_week']}{/if}"></td>
        						</tr>
        						<tr>
          		     				<th class="text-r" width="80">分娩方式：</th>
          			 				<td><input name="customer_delivery_mode" type="text" class="input-text" id="customer_delivery_mode" value="{if isset($info)}{$info['customer_delivery_mode']}{/if}"></td>
        						</tr>
        						<tr>
          		     				<th class="text-r" width="80">服务级别：</th>
          			 				<td>
          			 					{foreach $serviceLevel1 as $key => $item}
          			 					<input type="radio" name="customer_service_level2" value="{$key}"
          			 						{if isset($info) && $info['customer_service_type'] == 4 && $info['customer_service_level'] == $key}checked{/if}>{$item}&nbsp;&nbsp;
          			 					{/foreach}
          			 				</td>
        						</tr>
        					</tbody>
        				</table>
        			</td>
        		</tr>
          		<tr>
          			<th></th>
          			<td>
            			<button type="submit" class="btn btn-success radius"><i class="icon-ok"></i> {$typeMsg}</button>
          			</td>
        		</tr>
      		</tbody>
      	</table>
	</form>
</div>
<script type="text/template" id="departmentTpl">
<option value="">请选择科室</option>	
<%#departmentList%>
	<option value="<%wb_id%>">
	<%stationary_name%>
	</option>
<%/departmentList%>
</script>
<input type="hidden" id="getDepartmentUrl" value="{formatUrl('hospital/getDepartment')}"></input>
<script type="text/javascript" src="/public/common/js/hogan-2.0.0.min.js"></script>
<script type="text/javascript" src="/public/oa_admin/js/customer.js"></script>