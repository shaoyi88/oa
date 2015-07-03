<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  资料管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('user/index')}">用户信息管理</a> <span class="c-gray en">&gt;</span> {$typeMsg}</nav>
<div class="pd-20">
	<form class="Huiform" id="form-role-add" action="{formatUrl('user/doAdd')}" method="post">
		{if isset($info)}
		<input name="user_id" type="hidden" value="{$info['user_id']}">
		{/if}
		<table class="table table-border table-bordered table-bg">
      		<tbody>
      			<tr>
          		     <th class="text-r" width="80">姓名：</th>
          			 <td><input name="user_name" type="text" class="input-text" id="user_name" value="{if isset($info)}{$info['user_name']}{/if}" nullmsg="姓名不能为空！" datatype="s"></td>
        		</tr>
      			<tr>
          		     <th class="text-r" width="80">手机：</th>
          			 <td><input name="user_phone" type="text" class="input-text" id="user_phone" value="{if isset($info)}{$info['user_phone']}{/if}" errormsg="请输入正确的手机号码！" nullmsg="手机不能为空！" datatype="m"></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">性别：</th>
          			 <td>
          			 	<select class="select" id="user_sex" name="user_sex" nullmsg="性别不能为空！" datatype="*">
      						<option value="">请选择性别</option>
      						{foreach $sexInfo as $key => $item}
      						<option value="{$key}" {if isset($info) && $info['user_sex'] == $key}selected{/if}>
      						{$item}
      						</option>
      						{/foreach}
    					</select>
          			 </td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">地区：</th>
          			 <td>
          			 	<select target="user_city" style="width:30%" class="select" id="user_province" name="user_province" nullmsg="省份不能为空！" datatype="*">
          			 		<option value="">请选择</option>	
          			 		{foreach $provinceInfo as $item}
      							<option value="{$item['area_id']}" {if isset($info) && $info['user_province'] == $item['area_id']}selected{/if}>
      								{$item['area_name']}
      							</option>
      						{/foreach}
          			 	</select>
          			 	<select style="width:30%" class="select" id="user_city" name="user_city" nullmsg="市区不能为空！" datatype="*">
          			 		<option value="">请选择</option>	
          			 		{foreach $cityInfo as $item}
      							<option value="{$item['area_id']}" {if isset($info) && $info['user_city'] == $item['area_id']}selected{/if}>
      								{$item['area_name']}
      							</option>
      						{/foreach}
          			 	</select>
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
<input type="hidden" id="getAreasUrl" value="{formatUrl('areas/getAreas')}"></input>
<script type="text/javascript" src="/public/common/js/hogan-2.0.0.min.js"></script>
<script type="text/javascript" src="/public/oa_admin/js/user.js"></script>