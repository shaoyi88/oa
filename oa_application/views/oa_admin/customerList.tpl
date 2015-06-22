<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  资料管理 <span class="c-gray en">&gt;</span> 客户健康管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
	<form class="Huiform" action="{formatUrl('customer/index')}" method="post">
  		<div class="text-c"> 
   			<input nullmsg="搜索信息不可为空！" datatype="s" type="text" class="input-text" style="width:250px" placeholder="输入客户ID/客户姓名" id="keyword" name="keyword">
    		&nbsp;&nbsp;&nbsp;&nbsp;
    		<button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i> 搜客户</button>
  		</div>
  	</form>
  	{if checkRight('customer_add')}
	<div class="cl pd-5 bg-1 bk-gray" style="margin:10px 0">
    	<span class="l">
      		<a class="btn btn-primary radius" href="{formatUrl('customer/add')}"><i class="icon-plus"></i>添加</a>
    	</span>
  	</div>
  	{/if}
  	{if empty($dataList)}
  		<div class="cl pd-5 bg-1 bk-gray">
  			<h2 class="text-c">暂无客户</h2>
  		</div>
  	{else}
  		<table class="table table-border table-bordered table-hover table-bg">
    <thead>
      <tr class="text-c">
      	<th>ID</th>
        <th>姓名</th>
        <th>性别</th>
        <th>年龄</th>
        <th>身份证</th>
        <th>常用语言</th>
        <th>客户分组</th>
        <th>服务分组</th>
        <th>服务评估</th>
        <th width="105">操作</th>
      </tr>
    </thead>
    <tbody>
      {foreach $dataList as $item}
      <tr class="text-c">
      	<td>{$item['customer_id']}</td>
      	<td>{$item['customer_name']}</td>
      	<td>{$sexInfo[$item['customer_sex']]}</td>
        <td>{$item['customer_age']}</td>
        <td>{if $item['customer_card'] != ''}{$item['customer_card']}{else}暂无{/if}</td>
        <td>{$item['customer_language']}</td>
        <td>{$groupInfo[$item['customer_type']]}</td>
        <td>{$serviceTypeInfo[$item['customer_service_type']]}</td>
        <td>{if $item['customer_service_type'] == 4}{$serviceLevel2[$item['customer_service_level']]}{else}{$serviceLevel1[$item['customer_service_level']]}{/if}</td>
        <td class="f-14">
        	 <a title="详情" href="{formatUrl('customer/detail?cid=')}{$item['customer_id']}" style="text-decoration:none"><i class="icon-list-alt"></i></a>
        	 {if checkRight('customer_edit')}<a title="编辑" href="{formatUrl('customer/add?cid=')}{$item['customer_id']}" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a>{/if}
        	 {if checkRight('customer_del')}<a cid="{$item['customer_id']}" title="删除" href="javascript:;" class="ml-5 del" style="text-decoration:none"><i class="icon-trash"></i></a>{/if}
        </td>
      </tr>
      {/foreach}
    </tbody>
    </table>
    {if isset($pageUrl)}{$pageUrl}{/if}
  	{/if}
</div>
<input type="hidden" id="delUrl" value="{formatUrl('customer/doDel')}"></input>
<script type="text/javascript" src="/public/oa_admin/js/customer.js"></script>