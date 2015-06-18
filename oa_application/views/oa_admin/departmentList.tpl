<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i> 系统管理 <span class="c-gray en">&gt;</span> 组织部门管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20 text-c">
  {if checkRight('department_add')}
  <form class="Huiform" action="{formatUrl('department/doAdd')}" method="post">
    上级组织部门： <span class="select-box" style="width:150px">
    <select class="select" id="pid" name="pid">
      <option value="0">顶级组织部门</option>
      {foreach $dataList as $item}
      	<option value="{$item['id']}">
      		{if $item['level'] > 0}{str_repeat('&nbsp', $item['level']*2)}├ {/if}{$item['department_name']}
      	</option>
      {/foreach}
    </select>
    </span>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <span>
    	<input nullmsg="请输入组织部门！" datatype="s" class="input-text" style="width:250px" name="department_name" type="text" value="" placeholder="输入组织部门" id="article-class-val">
    </span>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <button type="submit" class="btn btn-success" id="" name=""><i class="icon-plus"></i> 添加</button>
  </form>
  {/if}
  {if empty($dataList)}
  <div class="cl pd-5 bg-1 bk-gray mt-20">
  	  <h2 class="text-c">暂无组织部门</h2>
  </div>
  {else}
  <div class="article-class-list cl mt-20">
    <table class="table table-border table-bordered table-hover table-bg">
      <thead>
        <tr class="text-c">
          <th>组织部门名称</th>
          <th width="70">操作</th>
        </tr>
      </thead>
      <tbody>
      	{foreach $dataList as $item}
      		<tr class="text-c">
          		<td class="text-l">{if $item['level'] > 0}{str_repeat('&nbsp', $item['level']*2)}├ {/if}{$item['department_name']}</td>
          		<td class="f-14" did="{$item['id']}" dname="{$item['department_name']}">
          			{if checkRight('department_edit')}<a class="edit" title="编辑" href="javascript:;" style="text-decoration:none"><i class="icon-edit"></i></a>{/if}
          			{if checkRight('department_del')}<a title="删除" href="javascript:;" class="ml-5 del" style="text-decoration:none"><i class="icon-trash"></i></a>{/if}
          		</td>
        	</tr>
      	{/foreach}
      </tbody>
    </table>
  </div>
  {/if}
</div>
<div class="pd-20 text-c" style="display:none" id="editWindow">
	<form class="Huiform" action="{formatUrl('department/doEdit')}" method="post">
		<input id="editId" type="hidden" value="" name="id"></input>
		<span><input id="editName" nullmsg="请输入组织部门！" datatype="s" class="input-text" style="width:250px" name="department_name" type="text" value="" placeholder="输入组织部门"></span>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<button style="margin-top:10px" type="submit" class="btn btn-success" id="" name=""><i class="icon-plus"></i>更新</button>
	</form>
</div>
<input type="hidden" id="delUrl" value="{formatUrl('department/doDel')}"></input>
<script type="text/javascript" src="/public/oa_admin/js/department.js"></script>