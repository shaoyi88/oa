<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  资料管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('user/index')}">用户信息管理</a> <span class="c-gray en">&gt;</span> {$typeMsg}</nav>
<div class="pd-20">
	<form class="Huiform" id="form-role-add" action="{formatUrl('user/doAdd')}" method="post">
		{if isset($info)}
		<input name="user_id" type="hidden" value="{$info['user_id']}">
		{/if}
		<table class="table table-border table-bordered table-bg">
      		<tbody>
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
<script type="text/javascript" src="/public/oa_admin/js/user.js"></script>