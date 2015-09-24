  <style type="text/css">
  {literal}.cityselect{display:none;background:#FFF;border:1px solid #ccc;}{/literal}
  {literal}.cityselect li{padding:2px;cursor:default;}{/literal}
  {literal}.cityselect li:hover{background:#319AFF;}{/literal}
  {literal}#citysearch{position:absolute;top:0;left:18%;width:15%;padding:8px;display:none;}{/literal}
  </style>
<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  护工管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('worker/index')}">护工信息管理</a> <span class="c-gray en">&gt;</span> {$typeMsg}</nav>
<div class="pd-20">
	<form class="Huiform" id="form-role-add" action="{formatUrl('worker/doAdd')}" method="post" enctype="multipart/form-data">
		{if isset($info)}
		<input name="worker_id" type="hidden" value="{$info['worker_id']}">
		{/if}
		<table class="table table-border table-bordered table-bg">
      		<tbody>
      		    <tr>
          		     <th class="text-r" width="80">*编号：</th>
          			 <td><input name="worker_no" type="text" class="input-text" id="worker_no" value="{if isset($info)}{$info['worker_no']}{/if}" nullmsg="护工编号不能为空！" datatype="*"></td>
        		</tr>
      		    <tr>
          		     <th class="text-r" width="80">*归属：</th>
          			 <td>
          			 <select target="worker_stationary" style="width:30%" class="select" id="worker_hospital" name="worker_hospital" nullmsg="医院不能为空！" datatype="*">
          			 		<option value="">请选择</option>
          			 		{foreach $hospitalInfo as $item}
      							<option value="{$item['wb_id']}" {if isset($info) && $info['worker_hospital'] == $item['wb_id']}selected{/if}>
      								{$item['stationary_name']}
      							</option>
      						{/foreach}
          			 	</select>
          			 	&nbsp;
          			 	<select style="width:30%" class="select" id="worker_stationary" name="worker_stationary" nullmsg="科室不能为空！" datatype="*">
          			 		<option value="">请选择</option>
          			 		{foreach $nInfo as $item}
      							<option value="{$item['wb_id']}" {if isset($info) && $info['worker_stationary'] == $item['wb_id']}selected{/if}>
      								{$item['stationary_name']}
      							</option>
      						{/foreach}
          			 	</select>
          			 	&nbsp;&nbsp;&nbsp;&nbsp;
          			 	目标医院/科室不存在？<a href="{formatUrl('hospital/Add')}" style="color:#5A98DE;">前往添加</a>
          			 </td>
        		</tr>
        		 <tr>
          		     <th class="text-r" width="80">头像：</th>
          			 <td>
          			 <span class="btn-upload form-group">
                     <input class="input-text upload-url radius" type="text" name="worker_icon" id="worker_icon" readonly >&nbsp;<a href="javascript:void();" class="btn btn-primary radius"><i class="iconfont">&#xf0020;</i> 浏览文件</a>
                     <input type="file" multiple name="worker_icon" class="input-file">
                     &nbsp;(不超过2M)
                     </span>
                     {if isset($info)&&$info['worker_icon']}&nbsp;&nbsp;<img src="/./upload/ico/{$info['worker_icon']}" height="40">{/if}</td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">*头衔：</th>
          			 <td>
          			    {foreach $title as $key => $item}
          			    <input type="radio" class="input-radio" id="worker_title" name="worker_title" value="{$key}" {if isset($info) && $info['worker_title'] == $key}checked{/if} nullmsg="头衔不能为空！" datatype="*">&nbsp;{$item}&nbsp;&nbsp;&nbsp;&nbsp;
          			    {/foreach}
          			 </td>
        		</tr>
      		    <tr>
          		     <th class="text-r" width="80">*姓名：</th>
          			 <td><input name="worker_name" type="text" class="input-text" id="worker_name" value="{if isset($info)}{$info['worker_name']}{/if}" nullmsg="姓名不能为空！" datatype="*"></td>
        		</tr>
      			<tr>
          		     <th class="text-r" width="80">*手机：</th>
          			 <td><input name="worker_phone" type="text" class="input-text" id="worker_phone" value="{if isset($info)}{$info['worker_phone']}{/if}" errormsg="请输入正确的手机号码！" nullmsg="手机不能为空！" datatype="m"></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">*性别：</th>
          			 <td>
          			    {foreach $sexInfo as $key => $item}
          			    <input type="radio" class="input-radio" id="worker_sex" name="worker_sex" value="{$key}" {if isset($info) && $info['worker_sex'] == $key}checked{/if} nullmsg="性别不能为空！" datatype="*">&nbsp;{$item}&nbsp;&nbsp;&nbsp;&nbsp;
          			    {/foreach}
          			 </td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">*婚姻状况：</th>
          			 <td>
          			    {foreach $marriage as $key => $item}
          			    <input type="radio" class="input-radio" id="worker_marriage" name="worker_marriage" value="{$key}" {if isset($info) && $info['worker_marriage'] == $key}checked{/if} nullmsg="婚姻状况不能为空！" datatype="*">&nbsp;{$item}&nbsp;&nbsp;&nbsp;&nbsp;
          			    {/foreach}
          			 </td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">*工作经验：</th>
          			 <td><input name="worker_experience" type="text" class="input-text" id="worker_experience" value="{if isset($info)}{$info['worker_experience']}{/if}" nullmsg="工作经验不能为空！" datatype="*"></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">*教育程度：</th>
          			 <td>
          			    {foreach $eduInfo as $key => $item}
          			    <input type="radio" class="input-radio" id="worker_education" name="worker_education" value="{$key}" {if isset($info) && $info['worker_education'] == $key}checked{/if} nullmsg="教育程度不能为空！" datatype="*">&nbsp;{$item}&nbsp;&nbsp;&nbsp;&nbsp;
          			    {/foreach}
          			 </td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">*身份证号：</th>
          			 <td><input name="worker_idnumber" type="text" class="input-text" id="worker_idnumber" value="{if isset($info)}{$info['worker_idnumber']}{/if}" nullmsg="身份证号不能为空！" datatype="*"></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">*户籍地址：</th>
          			 <td style="position:relative;">
                        <div id="citysearch">
                            <input id="getcity" type="text" class="input-text" style="width:98%;" placeholder="输入搜索或点右箭头选择">
          			 	    <ul class="cityselect"></ul>
          			 	</div>
          			 	<select target="worker_domicile_city" style="width:18%" class="select-box" id="worker_domicile_province" name="worker_domicile_province" nullmsg="省份不能为空！" datatype="*">
          			 		<option value="">请选择</option>
          			 		{foreach $provinceInfo as $item}
      							<option value="{$item['area_id']}" {if isset($info) && $info['worker_domicile_province'] == $item['area_id']}selected{/if}>
      								{$item['area_name']}
      							</option>
      						{/foreach}
          			 	</select>
          			 	&nbsp;
          			 	<select target="worker_domicile_district" class="select-box" id="worker_domicile_city" name="worker_domicile_city" nullmsg="市不能为空！" datatype="*" style="width:18%;">
          			 		<option value="">请选择</option>
          			 		{foreach $cityInfo as $item}
      							<option value="{$item['area_id']}" {if isset($info) && $info['worker_domicile_city'] == $item['area_id']}selected{/if}>
      								{$item['area_name']}
      							</option>
      						{/foreach}
          			 	</select>
          			 	&nbsp;
          			 	<select style="width:18%" class="select-box" id="worker_domicile_district" name="worker_domicile_district" nullmsg="区（县镇）不能为空！" datatype="*">
          			 		<option value="">请选择</option>
          			 		{foreach $districtInfo as $item}
      							<option value="{$item['area_id']}" {if isset($info) && $info['worker_domicile_district'] == $item['area_id']}selected{/if}>
      								{$item['area_name']}
      							</option>
      						{/foreach}
          			 	</select>
          			 	&nbsp;
          			 	<input style="width:38%" name="worker_domicile_address" type="text" class="input-text" id="worker_domicile_address" value="{if isset($info)}{$info['worker_domicile_address']}{/if}" nullmsg="详细地址不能为空！" placeholder="详细街道地址" datatype="*">
          			 </td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">员工特点：</th>
          			 <td><input name="worker_characteristic" type="text" class="input-text" id="worker_name" value="{if isset($info)}{$info['worker_characteristic']}{/if}" ></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">*提供服务：</th>
          			 <td>
          			    {foreach $workerService as $key => $item}
          			    <input type="radio" class="input-radio" id="worker_service" name="worker_service" value="{$key}" {if isset($info) && $info['worker_service'] == $key}checked{/if} nullmsg="服务不能为空！" datatype="*">&nbsp;{$item}&nbsp;&nbsp;&nbsp;&nbsp;
          			    {/foreach}
          			 </td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">*服务状态：</th>
          			 <td>
          			    {foreach $workerStatus as $key => $item}
          			    <input type="radio" class="input-radio" id="worker_status" name="worker_status" value="{$key}" {if isset($info) && $info['worker_status'] == $key}checked{/if} nullmsg="服务状态不能为空！" datatype="*">&nbsp;{$item}&nbsp;&nbsp;&nbsp;&nbsp;
          			    {/foreach}
          			 </td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">*服务模式：</th>
          			 <td>
          			    {foreach $serviceMode as $key => $item}
          			    <input type="radio" class="input-radio" id="worker_service_mode" name="worker_service_mode" value="{$key}" {if isset($info) && $info['worker_service_mode'] == $key}checked{/if} nullmsg="服务模式不能为空！" datatype="*">&nbsp;{$item}&nbsp;&nbsp;&nbsp;&nbsp;
          			    {/foreach}
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
<script type="text/template" id="areaTpl">
<option value="">请选择</option>
<%#areaList%>
	<option value="<%area_id%>">
	<%area_name%>
	</option>
<%/areaList%>
</script>
<script type="text/template" id="hospitalTpl">
<option value="">请选择</option>
<%#hospitalList%>
	<option value="<%wb_id%>">
	<%stationary_name%>
	</option>
<%/hospitalList%>
</script>
<input type="hidden" id="getAreasUrl" value="{formatUrl('areas/getAreas')}"></input>
<input type="hidden" id="getHospitalsUrl" value="{formatUrl('hospital/getDepartment')}"></input>
<input type="hidden" id="getCityUrl" value="{formatUrl('areas/getCity')}"></input>
<script type="text/javascript" src="/public/common/js/hogan-2.0.0.min.js"></script>
<script type="text/javascript" src="/public/oa_admin/js/worker.js"></script>