<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  意见建议管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('hospitaladvice/advice_list')}">意见建议</a> <span class="c-gray en">&gt;</span> {$typeMsg}</nav>
<div class="pd-20">
	<form class="Huiform" id="form-role-add" action="{formatUrl('hospitaladvice/doAdd')}" method="post">
		{if isset($info)}
		<input name="advice_id" type="hidden" value="{$info['advice_id']}">
		<input name="ap" type="hidden" value="{$ap}">
		{/if}
		<table class="table table-border table-bordered table-bg">
      		<tbody>
      		    {if isset($info)}
      		    <tr>
          		     <th class="text-r" width="100">发起人：</th>
          			 <td>{$info['admin_name']}</td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="100">发起时间：</th>
          			 <td>{date('Y-m-d',$info['added_time']+86400)}</td>
        		</tr>
        		{/if}
        		<tr>
          		     <th class="text-r" width="100">*医院科室：</th>
          			 <td>
          			 <select target="stationary_id" style="width:30%" class="select" name="hospital_id" id="hospital_id" nullmsg="医院不能为空！" datatype="*">
          			 		<option value="">请选择</option>
          			 		{foreach $hospitalInfo as $item}
      							<option value="{$item['wb_id']}" {if isset($info) && $info['hospital_id'] == $item['wb_id']}selected{/if}>
      								{$item['stationary_name']}
      							</option>
      						{/foreach}
          			 	</select>
          			 	&nbsp;
          			 	<select style="width:30%" class="select" id="stationary_id" name="stationary_id" nullmsg="科室不能为空！" datatype="*">
          			 		<option value="">请选择</option>
          			 		{foreach $nInfo as $item}
      							<option value="{$item['wb_id']}" {if isset($info) && $info['stationary_id'] == $item['wb_id']}selected{/if}>
      								{$item['stationary_name']}
      							</option>
      						{/foreach}
          			 </select>
           			 </td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="100">*意见建议：</th>
          			 <td><textarea name="advice_content" class="textarea" id="advice_content" nullmsg="内容不能为空！" datatype="*">{if isset($info)}{$info['advice_content']}{/if}</textarea></td>
        		</tr>
        		{if isset($info)&&$info['advice_status']==1&&$appointright}
        		<tr>
          		     <th class="text-r" width="100">指派给：</th>
          			 <td>
          			    <select class="select" id="appointed" name="appointed" >
      						<option value="">请选择指派给</option>
      						{foreach $hplist as $item}
      						<option value="{$item['admin_name']}" {if isset($info) && $info['appointed'] == $item['admin_name']}selected{/if}>
      						{$item['admin_name']}
      						</option>
      						{/foreach}
    					</select>
          			 </td>
        		</tr>
        		{/if}
        		{if isset($info)}
        		{if $info['advice_status']==2}
        		<tr>
          		     <th class="text-r" width="100">反馈：</th>
          			 <td><textarea name="feedback_content" class="input-text" id="feedback_content" nullmsg="反馈不能为空！" datatype="*">{if isset($info)}{$info['feedback_content']}{/if}</textarea></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="100">意见建议状态：</th>
          			 <td>
          			    <select class="select" id="advice_status" name="advice_status" >
      						{foreach $hpstatus as $key=>$item}
      						{if $key>1}
      						<option value="{$key}" {if $info['advice_status'] == $key}selected{/if}>
      						{$item}
      						</option>
      						{/if}
      						{/foreach}
    					</select>
          			 </td>
        		</tr>
        		{else}
        		<tr>
          		     <th class="text-r" width="100">意见建议状态：</th>
          			 <td>未指派</td>
        		</tr>
        		{/if}
        		{/if}
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
<script type="text/template" id="hospitalTpl">
<option value="">请选择</option>
<%#hospitalList%>
	<option value="<%wb_id%>">
	<%stationary_name%>
	</option>
<%/hospitalList%>
</script>
<input type="hidden" id="getHospitalsUrl" value="{formatUrl('hospital/getDepartment')}"></input>
<script type="text/javascript" src="/public/common/js/hogan-2.0.0.min.js"></script>
<script type="text/javascript" src="/public/oa_admin/js/hospitaladvice.js"></script>