<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  系统管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('admin/index?pid=')}{$did}">系统用户管理</a> <span class="c-gray en">&gt;</span> {$typeMsg}</nav>
<div class="pd-20">
	<form class="Huiform" id="form-role-add" action="{formatUrl('admin/doAdd')}" method="post">
		{if isset($info)}
		<input name="admin_id" type="hidden" value="{$info['admin_id']}">
		{/if}
		<input name="admin_department" type="hidden" value="{$did}">
		<table class="table table-border table-bordered table-bg">
			<tbody>
				<tr>
          		     <th class="text-r" width="80">账户：</th>
          			 <td><input name="admin_account" type="text" {if isset($info)}disabled{/if} class="input-text" id="admin_account" value="{if isset($info)}{$info['admin_account']}{/if}" nullmsg="账户不能为空！" datatype="s"></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">密码：</th>
          			 <td><input name="admin_password" type="password" class="input-text" id="admin_password" value="" {if !isset($info)}nullmsg="密码不能为空！" datatype="s"{/if}></td>
        		</tr>
      			<tr>
          		     <th class="text-r" width="80">工号：</th>
          			 <td><input name="admin_no" type="text" class="input-text" id="admin_no" value="{if isset($info)}{$info['admin_no']}{/if}" nullmsg="工号不能为空！" datatype="s"></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">姓名：</th>
          			 <td><input name="admin_name" type="text" class="input-text" id="admin_name" value="{if isset($info)}{$info['admin_name']}{/if}" nullmsg="姓名不能为空！" datatype="s"></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">手机：</th>
          			 <td><input name="admin_phone" type="text" class="input-text" id="admin_name" value="{if isset($info)}{$info['admin_phone']}{/if}"  errormsg="请输入正确的手机号码！" nullmsg="手机不能为空！" datatype="m"></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">分组：</th>
          			 <td>
          			 	<select class="select" id="admin_role" name="admin_role" nullmsg="分组不能为空！" datatype="*">
      						<option value="">请选择分组</option>
      						{foreach $roleList as $item}
      						<option value="{$item['id']}" {if isset($info) && $info['admin_role'] == $item['id']}selected{/if}>
      						{$item['role_name']}
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
<script type="text/javascript" src="/public/oa_admin/js/admin.js"></script>