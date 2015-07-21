<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  护工管理 <span class="c-gray en">&gt;</span> 护工信息管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
	<form class="Huiform" action="{formatUrl('worker/index')}" method="post">
  		<div class="text-c">
   			<input nullmsg="搜索信息不可为空！" datatype="s" type="text" class="input-text" style="width:250px" placeholder="输入员工编号/姓名/手机" id="keyword" name="keyword">
    		&nbsp;&nbsp;&nbsp;&nbsp;
    		<button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i> 搜护工</button>
  		</div>
  	</form>
  	{if checkRight('worker_add')}
	<div class="cl pd-5 bg-1 bk-gray" style="margin:10px 0">
    	<span class="l">
      		<a class="btn btn-primary radius" href="{formatUrl('worker/add')}"><i class="icon-plus"></i>添加</a>
    	</span>
  	</div>
  	{/if}
  	{if empty($dataList)}
  		<div class="cl pd-5 bg-1 bk-gray">
  			<h2 class="text-c">暂无护工</h2>
  		</div>
  	{else}
  		<table class="table table-border table-bordered table-hover table-bg">
    <thead>
      <tr class="text-c">
        <th>头像</th>
      	<th>编号</th>
        <th>姓名</th>
        <th>医院科室</th>
        <th>手机</th>
        <th>性别</th>
        <th>年龄</th>
        <th>工作经验</th>
        <th>工作状态</th>
        <th width="200">操作</th>
      </tr>
    </thead>
    <tbody>
      {foreach $dataList as $item}
      <tr class="text-c">
        <td>
        {if $item['worker_icon']}
        <img class="avatar size-s c" src="/./upload/ico/{$item['worker_icon']}" width="98%">
        {else}
 		<img class="avatar size-s c" src="/public/oa_admin/images/user.png" width="98%">
 	    {/if}
 	    </td>
      	<td>{$item['worker_no']}</td>
        <td>{$item['worker_name']}</td>
        <td>{$nInfo[$item['worker_hospital']]}&nbsp;&nbsp;{$nInfo[$item['worker_stationary']]}</td>
        <td>{$item['worker_phone']}</td>
        <td>{$sexInfo[$item['worker_sex']]}</td>
        <td>{$item['worker_age']}</td>
        <td>{$item['worker_experience']}</td>
        <td>{$wstatus[$item['worker_status']]}</td>
        <td class="f-14">
        	 <a title="详情" href="{formatUrl('worker/detail?wid=')}{$item['worker_id']}" class="btn btn-primary radius" style="text-decoration:none">详情</a>
        	 {if checkRight('worker_edit')}&nbsp;&nbsp;<a title="编辑" href="{formatUrl('worker/add?wid=')}{$item['worker_id']}" class="btn btn-primary radius" style="text-decoration:none">编辑</a>{/if}
        	 {if checkRight('worker_del')}&nbsp;&nbsp;<a wid="{$item['worker_id']}" title="删除" href="javascript:;" class="btn btn-primary radius del" style="text-decoration:none">删除</a>{/if}
        </td>
      </tr>
      {/foreach}
    </tbody>
    </table>
    {if isset($pageUrl)}{$pageUrl}{/if}
  	{/if}
</div>
<input type="hidden" id="delUrl" value="{formatUrl('worker/doDel')}"></input>
<script type="text/javascript" src="/public/oa_admin/js/worker.js"></script>