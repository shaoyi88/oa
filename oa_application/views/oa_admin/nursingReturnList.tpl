<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  服务跟踪管理 <span class="c-gray en">&gt;</span> 回访管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
	<form class="Huiform" action="{formatUrl('nursing/returnList')}" method="post">
  		<div class="text-c"> 
   			<input nullmsg="搜索信息不可为空！" datatype="s" type="text" class="input-text" style="width:250px" placeholder="输入客户名字" id="keyword" name="keyword">
    		&nbsp;&nbsp;&nbsp;&nbsp;
    		<button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i> 搜回访记录</button>
  		</div>
  		<input type="hidden" name="executive_admin_id" value="{$executive_admin_id}">
  	</form>
  	<div class="HuiTab">
 	 	<div class="tabBar cl">
 	 		<a href="{formatUrl('nursing/returnList')}"><span {if $executive_admin_id == ''}class="current"{/if}>全部回访记录</span></a>
 	 		<a href="{formatUrl('nursing/returnList?executive_admin_id=')}{$admin_id}"><span {if $executive_admin_id != ''}class="current"{/if}>我的回访记录</span></a>
 	 	</div>
	</div>
  	{if empty($dataList)}
  		<div class="cl pd-5 bg-1 bk-gray" style="margin:10px 0">
  			<h2 class="text-c">暂无回访记录</h2>
  		</div>
  	{else}
  	<table class="table table-border table-bordered table-hover table-bg" style="margin:10px 0">
    <thead>
      <tr class="text-c">
      	<th>护理计划ID</th>
        <th>客户名字</th>
        <th>客户地址</th>
        <th>回访时间</th>
        <th>回访记录</th>
        <th>推送内容</th>
        <th>执行人</th>
        <th>创建人</th>
        <th>状态</th>
        <th width="300">操作</th>
      </tr>
    </thead>
    <tbody>
      {foreach $dataList as $item}
      <tr class="text-c">
      	<td><a class="c-primary planDetail" pid="{$item['plan_id']}" title="护理计划详情" href="javascript:;"><u class="c-primar">{$item['plan_id']}</u></a></td>
        <td>{$item['customer_name']}</td>
        <td>{$item['customer_address']}</td>
        <td>{date('Y-m-d H:i:s', $item['return_time'])}</td>
        <td>{$item['return_record']}</td>
        <td>{$item['push_content']}</td>
     	<td>{$item['executive_admin_name']}</td>
        <td>{$item['admin_name']}</td>
        <td>{if $item['return_status'] == 0}未执行{else}已执行{/if}</td>
        <td>
        	 {if checkRight('nursing_return_register') && $item['return_status'] == 0 and $admin_id == $item['executive_admin_id']}&nbsp;&nbsp;<a class="btn btn-primary radius" title="回访登记" href="{formatUrl('nursing/returnRegister?rid=')}{$item['return_id']}" style="text-decoration:none;margin-bottom:10px">回访登记</a>{/if}
        	 {if checkRight('nursing_return_del') && ($admin_id == $item['executive_admin_id'] || $admin_id == $item['admin_id'])}&nbsp;&nbsp;<a class="btn btn-primary radius delReturn" rid="{$item['return_id']}" title="删除" href="javascript:;" style="text-decoration:none;margin-bottom:10px">删除</a>{/if}
        </td>
      </tr>
      {/foreach}
    </tbody>
    </table>
    {if isset($pageUrl)}{$pageUrl}{/if}
  	{/if}
</div>
<input type="hidden" id="planDetailUrl" value="{formatUrl('nursing/planDetail')}"></input>
<input type="hidden" id="delReturnUrl" value="{formatUrl('nursing/returnDoDel')}"></input>
<script type="text/javascript" src="/public/oa_admin/js/nursing.js"></script>