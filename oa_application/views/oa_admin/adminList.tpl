<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i> 系统管理 <span class="c-gray en">&gt;</span> 系统用户管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
	{if checkRight('admin_add')}
	<div class="cl pd-5 bg-1 bk-gray" style="margin-bottom:10px">
    	<span class="l">
      		<a class="btn btn-primary radius" href="{formatUrl('admin/add?did=')}{$pid}"><i class="icon-plus"></i>添加</a>
    	</span>
  	</div>
  	{/if}
  	{if empty($departmentTree)}
  		<div class="cl pd-5 bg-1 bk-gray">
  			<h2 class="text-c">暂无用户</h2>
  		</div>
  	{else}
	<div class="col-3 dTree">
		<table class="table table-border table-bg table-bordered table-hover">
      		<tbody>
      			{foreach $departmentTree as $item}
        		<tr did="{$item['id']}" {if $item['id'] == $pid}class="active"{/if}><td>{if $item['level'] > 0}{str_repeat('&nbsp', $item['level']*2)}├ {/if}{$item['department_name']}<b>&gt;</b></td></tr>
        		{/foreach}
      		</tbody>
    	</table>
	</div>
	<div class="col-9">
		{if empty($adminList)}
			<div class="cl pd-5 bg-1 bk-gray"><h2 class="text-c">该部门下暂无用户</h2></div>
		{else}
		<table class="table table-border table-bg table-bordered table-hover">
			<thead>
        		<tr class="text-c">
          		<th>用户名</th>
          		<th width="70">操作</th>
        		</tr>
      		</thead>
			<tbody>
				{foreach $adminList as $item}
					<tr class="text-c">
        				<td class="text-l">{$item['admin_name']}</td>
          				<td class="f-14">
          				{if checkRight('admin_edit')}<a class="edit" title="编辑" href="{formatUrl('admin/add?id=')}{$item['admin_id']}&did={$pid}" style="text-decoration:none"><i class="icon-edit"></i></a>{/if}
          				{if checkRight('admin_del')}<a aid="{$item['admin_id']}" pid="{$pid}" title="删除" href="javascript:;" class="ml-5 del" style="text-decoration:none"><i class="icon-trash"></i></a>{/if}
          				</td>
          			</tr>
				{/foreach}
			</tbody>
		</table>
		{/if}
	</div>
	{/if}
</div>
<script type="text/javascript" src="/public/oa_admin/js/admin.js"></script>
<input type="hidden" id="indexUrl" value="{formatUrl('admin/index')}"></input>
<input type="hidden" id="delUrl" value="{formatUrl('admin/doDel')}"></input>