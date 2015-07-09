<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  签约管理 <span class="c-gray en">&gt;</span> 订单管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
	<form class="Huiform" action="{formatUrl('order/index')}" method="post">
  		<div class="text-c"> 
   			<input nullmsg="搜索信息不可为空！" datatype="s" type="text" class="input-text" style="width:250px" placeholder="输入订单编号/用户ID/客户ID" id="keyword" name="keyword">
    		&nbsp;&nbsp;&nbsp;&nbsp;
    		<button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i> 搜订单</button>
  		</div>
  	</form>
  	{if checkRight('order_add')}
	<div class="cl pd-5 bg-1 bk-gray" style="margin:10px 0">
    	<span class="l">
      		<a class="btn btn-primary radius" href="{formatUrl('order/add')}"><i class="icon-plus"></i>添加</a>
    	</span>
  	</div>
  	{/if}
  	{if empty($dataList)}
  		<div class="cl pd-5 bg-1 bk-gray">
  			<h2 class="text-c">暂无订单</h2>
  		</div>
  	{else}
  		<table class="table table-border table-bordered table-hover table-bg">
    <thead>
      <tr class="text-c">
      	<th>订单编号</th>
        <th>服务类型</th>
        <th>服务模式</th>
        <th>收费</th>
        <th>开始时间</th>
        <th>截至时间</th>
        <th>预收款</th>
        <th>费用总额</th>
        <th>订单状态</th>
        <th width="300">操作</th>
      </tr>
    </thead>
    <tbody>
      {foreach $dataList as $item}
      <tr class="text-c">
      	<td><a class="c-primary" title="详情" href="{formatUrl('order/detail?oid=')}{$item['order_id']}"><u class="c-primar">{$item['order_no']}</u></a></td>
        <td>{$serviceTypeInfo[$item['service_type']]}</td>
        <td>{$order_service_mode[$item['service_mode']][0]}</td>
        <td>{$item['order_fee']}元/{$order_fee_unit[$item['order_fee_unit']]}</td>
        <td>{date('Y-m-d H:i:s',$item['order_start_time'])}</td>
        <td>{if $item['order_end_time']}{date('Y-m-d H:i:s',$item['order_start_time'])}{else}未结束{/if}</td>
        <td>{if $item['order_advance_payment']}{$item['order_advance_payment']}元{else}暂无{/if}</td>
        <td>{if $item['order_total_cost']}{$item['order_total_cost']}元{else}未结算{/if}</td>
        <td>{$order_status[$item['order_status']]}</td>
        <td>
        	 {if checkRight('order_set_worker') && $item['order_status'] == 1}&nbsp;&nbsp;<a class="btn btn-primary radius" title="指派护工" href="{formatUrl('order/setWorker?oid=')}{$item['order_id']}" style="text-decoration:none;margin-bottom:10px">指派护工</a>{/if}
        	 {if checkRight('order_change_worker') && $item['order_status'] == 2}&nbsp;&nbsp;<a class="btn btn-primary radius" title="更换护工" href="{formatUrl('order/changeWorker?oid=')}{$item['order_id']}" style="text-decoration:none;margin-bottom:10px">更换护工</a>{/if}
        	 {if checkRight('order_collection') && $item['order_status'] == 2}&nbsp;&nbsp;<a class="btn btn-primary radius" title="收款" href="{formatUrl('order/collection?oid=')}{$item['order_id']}" style="text-decoration:none;margin-bottom:10px">收款</a>{/if}
        	 {if checkRight('order_edit') && ($item['order_status'] == 1 || $item['order_status'] == 2)}&nbsp;&nbsp;<a class="btn btn-primary radius" title="编辑" href="{formatUrl('order/add?oid=')}{$item['order_id']}" style="text-decoration:none;margin-bottom:10px">编辑</a>{/if}
        	 {if checkRight('order_cancel') && $item['order_status'] == 1}&nbsp;&nbsp;<a class="btn btn-primary radius cancel" oid="{$item['order_id']}" title="取消" href="javascript:;" style="text-decoration:none;margin-bottom:10px">取消</a>{/if}
        	 {if checkRight('order_del') && $item['order_status'] == 5}&nbsp;&nbsp;<a class="btn btn-primary radius del" oid="{$item['order_id']}" title="删除" href="javascript:;" style="text-decoration:none;margin-bottom:10px">删除</a>{/if}
        </td>
      </tr>
      {/foreach}
    </tbody>
    </table>
    {if isset($pageUrl)}{$pageUrl}{/if}
  	{/if}
</div>
<input type="hidden" id="delUrl" value="{formatUrl('order/doDel')}"></input>
<input type="hidden" id="cancelUrl" value="{formatUrl('order/doCancel')}"></input>
<script type="text/javascript" src="/public/oa_admin/js/order.js"></script>