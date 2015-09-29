<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  系统管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('department/index')}">组织部门管理</a> <span class="c-gray en">&gt;</span> {$typeMsg}</nav>
<div class="pd-20">
	<form class="Huiform" id="form-role-add" action="{formatUrl('department/doAdd')}" method="post">
		{if isset($info)}
		<input name="id" type="hidden" value="{$info['id']}">
		{/if}
		<table class="table table-border table-bordered table-bg">
			<tbody>
				<tr>
          		     <th class="text-r" width="180">上级组织部门：</th>
          			 <td>
          			 	<select class="select" id="pid" name="pid">
      						<option value="0">顶级组织部门</option>
      						{foreach $dataList as $item}
      						<option value="{$item['id']}" {if isset($info) && $info['pid'] == $item['id']}selected{/if}>
      						{if $item['level'] > 0}{str_repeat('&nbsp', $item['level']*2)}├ {/if}{$item['department_name']}
      						</option>
      						{/foreach}
    					</select>
          			 </td>
        		</tr>
				<tr>
          		     <th class="text-r" width="180">组织部门名称：</th>
          			 <td><input nullmsg="请输入组织部门名称！" datatype="s" class="input-text" style="width:250px" name="department_name" type="text" value="{if isset($info)}{$info['department_name']}{/if}" placeholder="输入组织部门名称" id="article-class-val"></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="180">关联机构医院：</th>
          			 <td>
          			 	<select class="select" id="hospital_id" name="hospital_id">
      						<option value="0">非机构</option>
      						{foreach $hospitalList as $item}
      						<option value="{$item['wb_id']}" {if isset($info) && $info['hospital_id'] == $item['wb_id']}selected{/if}>
      						{$item['stationary_name']}
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
<script type="text/javascript" src="/public/oa_admin/js/department.js""></script>