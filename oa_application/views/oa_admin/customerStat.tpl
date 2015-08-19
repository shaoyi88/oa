<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  资料管理 <span class="c-gray en">&gt;</span> 客户统计分析 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
    <form class="Huiform pd-20" action="{formatUrl('customer/stat')}" method="post">
  		<div class="text-c"> 
   			<select class="select" id="customer_type" name="customer_type" style="width:15%;height:30px">
      			<option value="">请选择客户分组</option>
      			{foreach $groupInfo as $key => $item}
      			<option value="{$key}" {if isset($customer_type) && $customer_type == $key}selected{/if}>
      			{$item}
      			</option>
      			{/foreach}
    		</select>
    		&nbsp;&nbsp;&nbsp;&nbsp;
    		<span id="hospitalInfo" {if isset($customer_type) && $customer_type == 2}{else}style="display:none"{/if}>
    		<select target="customer_hospital_department"  style="width:15%;height:30px" class="select" id="customer_hospital" name="customer_hospital">
      			<option value="">请选择医院</option>
      			{foreach $hospitalInfo as $item}
      			<option value="{$item['wb_id']}" {if isset($customer_hospital) && $customer_hospital == $item['wb_id']}selected{/if}>
      			{$item['stationary_name']}
      			</option>
      			{/foreach}
    		</select>
    		&nbsp;&nbsp;&nbsp;&nbsp;
    		<select style="width:15%;height:30px" class="select" id="customer_hospital_department" name="customer_hospital_department">
      			<option value="">请选择科室</option>
      			{foreach $departmentInfo as $item}
      			<option value="{$item['wb_id']}" {if isset($customer_hospital_department) && $customer_hospital_department == $item['wb_id']}selected{/if}>
      			{$item['stationary_name']}
      			</option>
      			{/foreach}
    		</select>
    		&nbsp;&nbsp;&nbsp;&nbsp;
    		</span>
    		<select class="select" id="customer_service_type" name="customer_service_type" style="width:15%;height:30px">
      			<option value="">请选择服务分组</option>
      			{foreach $serviceTypeInfo as $key => $item}
      			<option value="{$key}" {if isset($customer_service_type) && $customer_service_type == $key}selected{/if}>
      			{$item}
      			</option>
      			{/foreach}
    		</select>
    		&nbsp;&nbsp;&nbsp;&nbsp;
    		<button type="submit" class="btn btn-success" id="" name="" style="width:15%;"><i class="icon-search"></i>搜索</button>
  		</div>
  	</form>
  	<table class="table table-border table-bordered table-hover table-bg">
  		<thead>
      		<tr class="text-c">
      			<th>客户分组</th>
      			<th>医院</th>
      			<th>科室</th>
        		<th>服务分组</th>
        		<th>数量</th>
      		</tr>
    	</thead>
    	<tbody>
    		{foreach $statInfo as $k=>$stat}
    		<tr class="text-c">
    			{if !isset($showCustomerType[$stat['customer_type']])}<td rowspan="{$customerTypeNum[$stat['customer_type']]}">{$groupInfo[$stat['customer_type']]}({$customerTypeSum[$stat['customer_type']]})</td>{/if}
    			{if !isset($showCustomerHospital[$stat['customer_hospital']])}<td rowspan="{$customerHospitalNum[$stat['customer_hospital']]}">{if $stat['customer_hospital']==0}NAN{else}{$hospitalNameInfo[$stat['customer_hospital']]}({$customerHospitalSum[$stat['customer_hospital']]}){/if}</td>{/if}
    			{if !isset($showCustomerHospitalDepartment[$stat['customer_hospital_department']])}<td rowspan="{$customerHospitalDepartmentNum[$stat['customer_hospital_department']]}">{if $stat['customer_hospital_department']==0}NAN{else}{$hospitalNameInfo[$stat['customer_hospital_department']]}({$customerHospitalDepartmentSum[$stat['customer_hospital_department']]}){/if}</td>{/if}
    			<td>{$serviceTypeInfo[$stat['customer_service_type']]}</td>
    			<td>{$stat['sum']}</td>
    			{capture}{$showCustomerType[$stat['customer_type']]=1}{/capture}
    			{capture}{$showCustomerHospital[$stat['customer_hospital']]=1}{/capture}
    			{capture}{$showCustomerHospitalDepartment[$stat['customer_hospital_department']]=1}{/capture}
    		</tr>
    		{/foreach}
    		<tr class="text-c">
    			<td colspan="4">总计</td>
    			<td>{$sum}</td>
    		</tr>
    	</tbody>
  	</table>
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
<script type="text/javascript" src="/public/oa_admin/js/customerStat.js"></script>