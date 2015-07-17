<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  系统管理 <span class="c-gray en">&gt;</span> 分组权限管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
	{if checkRight('role_add')}
	<div class="cl pd-5 bg-1 bk-gray" style="margin-bottom:10px">
    	<span class="l">
      		<a class="btn btn-primary radius" href="{formatUrl('role/add')}"><i class="icon-plus"></i>添加</a>
    	</span>
  	</div>
  	{/if}
  	{if empty($dataList)}
  		<div class="cl pd-5 bg-1 bk-gray">
  			<h2 class="text-c">暂无分组</h2>
  		</div>
  	{else}
  	<table class="table table-border table-bordered table-hover table-bg">
    <thead>
      <tr class="text-c">
        <th>分组名</th>
        <th width="20%">操作</th>
      </tr>
    </thead>
    <tbody>
      {foreach $dataList as $item}
      <tr class="text-c">
        <td>{$item['role_name']}</td>
        <td>
        	 {if checkRight('role_edit')}<a class="btn btn-primary radius" title="编辑" href="{formatUrl('role/add?id=')}{$item['id']}" style="text-decoration:none">编辑</a>{/if}
        	 {if checkRight('role_del')}<a rid="{$item['id']}" title="删除" href="javascript:;" class="ml-5 del btn btn-primary radius" style="text-decoration:none">删除</a>{/if}
        </td>
      </tr>
      {/foreach}
    </tbody>
    </table>
    {/if}
</div>
<script type="text/javascript" src="/public/oa_admin/js/role.js"></script>
<input type="hidden" id="delUrl" value="{formatUrl('role/doDel')}"></input>