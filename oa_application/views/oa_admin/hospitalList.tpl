<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>驻点医院管理 <span class="c-gray en">&gt;</span> 医院管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
	<form class="Huiform" action="{formatUrl('hospital/index')}" method="post">
  		<div class="text-c">
   			<input nullmsg="搜索信息不可为空！" datatype="s" type="text" class="input-text" style="width:250px" placeholder="输入医院名/科室名" id="keyword" name="keyword">
    		&nbsp;&nbsp;&nbsp;&nbsp;
    		<button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i> 搜医院</button>
  		</div>
  	</form>
  	{if checkRight('hospital_add')}
	<div class="cl pd-5 bg-1 bk-gray" style="margin:10px 0">
    	<span class="l">
      		<a class="btn btn-primary radius" href="{formatUrl('hospital/add')}"><i class="icon-plus"></i>添加</a>
    	</span>
  	</div>
  	{/if}
  	{if empty($dataList)}
  		<div class="cl pd-5 bg-1 bk-gray">
  			<h2 class="text-c">暂无医院</h2>
  		</div>
  	{else}
  		<table class="table table-border table-bordered table-hover table-bg">
    <thead>
      <tr class="text-c">
      	<th>医院</th>
        <th>科室</th>
        <th width="150">操作</th>
      </tr>
    </thead>
    <tbody>
      {foreach $dataList as $k=>$item}
      <tr class="text-c">
      <td rowspan="{count($item)}">{$hospital[$k]}</td>
      <td>{if isset($item[0]['stationary_name'])}{$item[0]['stationary_name']}{/if}</td>
      <td rowspan="{count($item)}">{if checkRight('hospital_edit')}<a title="编辑" href="{formatUrl('hospital/add?hid=')}{$k}" class="btn btn-primary radius" style="text-decoration:none">编辑</a>{/if}{if checkRight('hospital_del')}&nbsp;&nbsp;<a wid="{$k}" title="删除" href="javascript:;" class="btn btn-primary radius del" style="text-decoration:none">删除</a>{/if}</td>
      </tr>
      {foreach $item as $k=>$h}
      {if $k>0}
      <tr class="text-c"><td>{$h['stationary_name']}</td></tr>
      {/if}
      {/foreach}
      {/foreach}
    </tbody>
    </table>
    {if isset($pageUrl)}{$pageUrl}{/if}
  	{/if}
</div>
<input type="hidden" id="delUrl" value="{formatUrl('hospital/doDel')}"></input>
<script type="text/javascript" src="/public/oa_admin/js/worker.js"></script>