<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  资料管理 <span class="c-gray en">&gt;</span> 用户信息管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
	<form class="Huiform" action="{formatUrl('user/index')}" method="post">
  		<div class="text-c"> 
   			<input nullmsg="搜索信息不可为空！" datatype="s" type="text" class="input-text" style="width:250px" placeholder="输入微信号/姓名/手机" id="keyword" name="keyword">
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
        <th>昵称</th>
        <th>微信</th>
        <th>手机</th>
        <th>性别</th>
        <th>地区</th>
        <th>最近访问时间</th>
        <th width="70">操作</th>
      </tr>
    </thead>
    <tbody>
      {foreach $dataList as $item}
      <tr class="text-c">
        <td>{$item['user_nickname']}</td>
        <td>{$item['user_weixin']}</td>
        <td>{$item['user_phone']}</td>
        <td></td>
        <td></td>
        <td></td>
        <td class="f-14">
        	 {if checkRight('user_edit')}<a title="编辑" href="{formatUrl('user/add?id=')}{$item['user_id']}" style="text-decoration:none"><i class="icon-edit"></i></a>{/if}
        	 {if checkRight('user_del')}<a uid="{$item['user_id']}" title="删除" href="javascript:;" class="ml-5 del" style="text-decoration:none"><i class="icon-trash"></i></a>{/if}
        </td>
      </tr>
      {/foreach}
    </tbody>
    </table>
    {$pageUrl}
  	{/if}
</div>
<script type="text/javascript" src="{$JS_PATH}user.js?v={$VERSION}"></script>