<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  服务跟踪管理 <span class="c-gray en">&gt;</span> 护理计划管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
	<form class="Huiform" action="{formatUrl('nursing/planList')}" method="post">
  		<div class="text-c"> 
   			<input nullmsg="搜索信息不可为空！" datatype="s" type="text" class="input-text" style="width:250px" placeholder="输入订单编号/客户名字/护工姓名" id="keyword" name="keyword">
    		&nbsp;&nbsp;&nbsp;&nbsp;
    		<button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i> 搜护理计划</button>
  		</div>
  	</form>
  	{if checkRight('nursing_plan_list')}
	<div class="cl pd-5 bg-1 bk-gray" style="margin:10px 0">
    	<span class="l">
      		<a class="btn btn-primary radius" href="{formatUrl('nursing/planAdd')}"><i class="icon-plus"></i>添加</a>
    	</span>
  	</div>
  	{/if}
  	{if empty($dataList)}
  		<div class="cl pd-5 bg-1 bk-gray">
  			<h2 class="text-c">暂无护理计划</h2>
  		</div>
  	{else}
  		<table class="table table-border table-bordered table-hover table-bg">
    <thead>
      <tr class="text-c">
      	<th>订单编号</th>
        <th>客户名字</th>
        <th>护工名字</th>
        <th>安全问题</th>
        <th>能力锻炼</th>
        <th>营养饮食</th>
        <th>创建时间</th>
        <th>创建人</th>
        <th width="300">操作</th>
      </tr>
    </thead>
    <tbody>
      {foreach $dataList as $item}
      <tr class="text-c">
      	<td><a class="c-primary orderDetail" oid="{$item['order_id']}" title="订单详情" href="javascript:;"><u class="c-primar">{$item['order_no']}</u></a></td>
        <td><a class="c-primary customerDetail" cid="{$item['customer_id']}" title="客户详情" href="javascript:;"><u class="c-primar">{$item['customer_name']}</u></a></td>
        <td><a class="c-primary workerDetail" wid="{$item['worker_id']}" title="护工详情" href="javascript:;"><u class="c-primar">{$item['worker_name']}</u></a></td>
        <td>{$item['safety_problem']}</td>
        <td>{$item['ability_training']}</td>
        <td>{$item['nutrition_diet']}</td>
        <td>{date('Y-m-d H:i:s',$item['add_time'])}</td>
        <td>{$item['admin_name']}</td>
        <td>
        	 {if checkRight('nursing_return_add')}<a class="btn btn-primary radius" title="添加回访计划" href="{formatUrl('nursing/returnAdd?pid=')}{$item['plan_id']}&cid={$item['customer_id']}" style="text-decoration:none;margin-bottom:10px">添加回访计划</a>{/if}
        	 {if checkRight('nursing_plan_edit')}&nbsp;&nbsp;<a class="btn btn-primary radius" title="编辑" href="{formatUrl('nursing/planAdd?pid=')}{$item['plan_id']}" style="text-decoration:none;margin-bottom:10px">编辑</a>{/if}
        	 {if checkRight('nursing_plan_del')}&nbsp;&nbsp;<a class="btn btn-primary radius delPlan" pid="{$item['plan_id']}" title="删除" href="javascript:;" style="text-decoration:none;margin-bottom:10px">删除</a>{/if}
        </td>
      </tr>
      {/foreach}
    </tbody>
    </table>
    {if isset($pageUrl)}{$pageUrl}{/if}
  	{/if}
</div>
<input type="hidden" id="customerDetailUrl" value="{formatUrl('customer/detail')}"></input>
<input type="hidden" id="workerDetailUrl" value="{formatUrl('worker/detail')}"></input>
<input type="hidden" id="orderDetailUrl" value="{formatUrl('order/detail')}"></input>
<input type="hidden" id="delPlanUrl" value="{formatUrl('nursing/planDoDel')}"></input>
<script type="text/javascript" src="/public/oa_admin/js/nursing.js"></script>