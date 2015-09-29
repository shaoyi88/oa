<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i> 系统管理 <span class="c-gray en">&gt;</span> 组织部门管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20 text-c"> 	
  {if checkRight('department_add')}
  <div class="cl pd-5 bg-1 bk-gray" style="margin-bottom:10px">
    	<span class="l">
      		<a class="btn btn-primary radius" href="{formatUrl('department/add')}"><i class="icon-plus"></i>添加</a>
    	</span>
  </div>
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
          <th>关联机构医院</th>
          <th width="20%">操作</th>
        </tr>
      </thead>
      <tbody>
      	{foreach $dataList as $item}
      		<tr class="text-c">
          		<td class="text-l">{if $item['level'] > 0}{str_repeat('&nbsp', $item['level']*2)}├ {/if}{$item['department_name']}</td>
          		<td class="text-c">{if $item['hospital_id'] == 0}非机构{else}{$hospital[$item['hospital_id']]}{/if}</td>
          		<td did="{$item['id']}" dname="{$item['department_name']}">
          			{if checkRight('department_edit')}<a class="edit btn btn-primary radius" title="编辑" href="{formatUrl('department/add?did=')}{$item['id']}" style="text-decoration:none">编辑</a>{/if}
          			{if checkRight('department_del')}<a title="删除" href="javascript:;" class="ml-5 del btn btn-primary radius" style="text-decoration:none">删除</a>{/if}
          		</td>
        	</tr>
      	{/foreach}
      </tbody>
    </table>
  </div>
  {/if}
</div>
<input type="hidden" id="delUrl" value="{formatUrl('department/doDel')}"></input>
<script type="text/javascript" src="/public/oa_admin/js/department.js"></script>