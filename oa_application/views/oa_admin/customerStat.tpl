<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  资料管理 <span class="c-gray en">&gt;</span> 客户统计分析 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
	<div class="HuiTab">
    	<div class="tabBar cl"><span>用户统计</span><span>客户统计</span></div>
    	<div class="tabCon">
    		<form class="Huiform pd-20" action="{formatUrl('customer/stat')}" method="post">
  				<div class="text-c"> 
   					<input nullmsg="搜索信息不可为空！" datatype="n" type="text" class="input-text" style="width:250px" placeholder="输入天数" name="dayNum">
    				&nbsp;&nbsp;&nbsp;&nbsp;
    				<button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i> N天内活跃用户</button>
  				</div>
  			</form>
  			<table class="table table-border table-bordered table-bg">
    			<thead>
      				<tr>
        				<th scope="col" colspan="7">信息统计</th>
      				</tr>
    			</thead>
    			<tbody>
      				<tr class="text-c">
        				<td width="20%">用户总数</td>
        				<td>{$userCount}</td>
      				</tr>
      				{if isset($userCountDayNum)}
      					<tr class="text-c">
        					<td><font style="color:red">{$dayNum}</font>天内活跃用户总数</td>
        					<td>{$userCountDayNum}</td>
      					</tr>
      				{/if}
    			</tbody>
  			</table>
    	</div>
    	<div class="tabCon">
    		<form class="Huiform pd-20" action="{formatUrl('customer/stat')}" method="post">
  				<div class="text-c"> 
  					<input type="hidden" name="tabType" value="1">
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
    				<select style="width:15%;height:30px" class="select" id="customer_hospital" name="customer_hospital">
      					<option value="">请选择医院</option>
    				</select>
    				&nbsp;&nbsp;&nbsp;&nbsp;
    				<select style="width:15%;height:30px" class="select" id="customer_hospital_department" name="customer_hospital_department">
      					<option value="">请选择科室</option>
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
  			<table class="table table-border table-bordered table-bg">
    			<thead>
      				<tr>
        				<th scope="col" colspan="7">信息统计</th>
      				</tr>
    			</thead>
    			<tbody>
      				<tr class="text-c">
        				<td width="20%">客户总数</td>
        				<td>{$customerCount}</td>
      				</tr>
      				{if isset($queryCustomerCount)}
      				<tr class="text-c">
        				<td><font style="color:red">{if isset($customer_type)}{$groupInfo[$customer_type]}{/if}{if isset($customer_service_type)}&nbsp;&nbsp;{$serviceTypeInfo[$customer_service_type]}{/if}</font>客户总数</td>
        				<td>{$queryCustomerCount}</td>
      				</tr>
      				{/if}
    			</tbody>
  			</table>
    	</div>
	</div>
</div>
<input type="hidden" id="tabType" value="{$tabType}">
<script type="text/javascript" src="/public/oa_admin/js/customerStat.js"></script>