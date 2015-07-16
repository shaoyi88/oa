<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  资料管理 <span class="c-gray en">&gt;</span> 用户信息管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
	<form class="Huiform" action="{formatUrl('user/index')}" method="post">
  		<div class="text-c"> 
   			<input nullmsg="搜索信息不可为空！" datatype="s" type="text" class="input-text" style="width:250px" placeholder="输入用户ID/姓名/微信号/昵称/手机" id="keyword" name="keyword">
    		&nbsp;&nbsp;&nbsp;&nbsp;
    		<button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i> 搜用户</button>
  		</div>
  	</form>
  	{if checkRight('user_add')}
	<div class="cl pd-5 bg-1 bk-gray" style="margin:10px 0">
    	<span class="l">
      		<a class="btn btn-primary radius" href="{formatUrl('user/add')}"><i class="icon-plus"></i>添加</a>
    	</span>
  	</div>
  	{/if}
  	{if empty($dataList)}
  		<div class="cl pd-5 bg-1 bk-gray">
  			<h2 class="text-c">暂无用户</h2>
  		</div>
  	{else}
  		<table class="table table-border table-bordered table-hover table-bg">
    <thead>
      <tr class="text-c">
      	<th>ID</th>
      	<th>姓名</th>
        <th>昵称</th>
        <th>微信</th>
        <th>手机</th>
        <th>性别</th>
        <th>地区</th>
        <th>最近访问时间</th>
        <th width="105">操作</th>
      </tr>
    </thead>
    <tbody>
      {foreach $dataList as $item}
      <tr class="text-c">
      	<td>{$item['user_id']}</td>
      	<td>{$item['user_name']}</td>
        <td>{if $item['user_nickname'] != ''}{$item['user_nickname']}{else}暂无{/if}</td>
        <td>{if $item['user_weixin'] != ''}{$item['user_weixin']}{else}暂无{/if}</td>
        <td>{$item['user_phone']}</td>
        <td>{$sexInfo[$item['user_sex']]}</td>
        <td>
        {if $item['user_province'] != 0}{$areasInfo[$item['user_province']]}{/if}
        &nbsp;&nbsp;
        {if $item['user_city'] != 0}{$areasInfo[$item['user_city']]}{/if}
        </td>
        <td>{if $item['user_last_visit_time'] != ''}{date('Y-m-d H:i:s',$item['user_last_visit_time'])}{else}暂无{/if}</td>
        <td class="f-14">
        	 <a title="详情" href="{formatUrl('user/detail?uid=')}{$item['user_id']}" style="text-decoration:none"><i class="icon-list-alt"></i></a>
        	 {if checkRight('user_edit')}<a title="编辑" href="{formatUrl('user/add?uid=')}{$item['user_id']}" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a>{/if}
        	 {if checkRight('user_del')}<a uid="{$item['user_id']}" title="删除" href="javascript:;" class="ml-5 del" style="text-decoration:none"><i class="icon-trash"></i></a>{/if}
        </td>
      </tr>
      {/foreach}
    </tbody>
    </table>
    {if isset($pageUrl)}{$pageUrl}{/if}
  	{/if}
</div>
<input type="hidden" id="delUrl" value="{formatUrl('user/doDel')}"></input>
<script type="text/javascript" src="/public/oa_admin/js/user.js"></script>