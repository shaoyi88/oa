<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  系统管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('role/index')}">分组权限管理</a> <span class="c-gray en">&gt;</span> {$typeMsg}</nav>
<div class="pd-20">
	<form class="Huiform" id="form-role-add" action="{formatUrl('role/doAdd')}" method="post">
		{if isset($info)}
		<input name="id" type="hidden" value="{$info['id']}">
		{/if}
		<table class="table table-border table-bordered table-bg">
      		<tbody>
      			 <tr>
          		     <th class="text-r" width="80">分组名：</th>
          			 <td><input name="role_name" type="text" class="input-text" id="role_name" value="{if isset($info)}{$info['role_name']}{/if}" nullmsg="分组名不能为空！" datatype="s"></td>
        		</tr>
        		<tr>
          			<th class="text-r va-t">权限：</th>
          			<td>
          				<table class="table table-border table-bordered table-bg">
              				<tbody>
              					{foreach $roleList as $item}
                				<tr>
                  					<th width="200">{$item['module']}</th>
                  					<td class="permission-list">
                  						
                  						{foreach $item['roles'] as $roleItem}                  					
                    						<label class="item"><input datatype="*" nullmsg="请至少选择一个权限！" name="role_rights[]" type="checkbox" value="{$roleItem[1]}" {if isset($roles) && in_array($roleItem[1], $roles)}checked{/if}>{$roleItem[0]}</label>
                    						{if isset($roleItem[2])} <div class="cl"></div>{/if}
                    					{/foreach}
									</td>
                				</tr>
                				{/foreach}
                				<tr>
                					<td colspan="2">
                						<div class="cl"><input class="btn btn-success radius allSelect" type="button" value="全选"></div>
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
<script type="text/javascript" src="/public/oa_admin/js/role.js"></script>