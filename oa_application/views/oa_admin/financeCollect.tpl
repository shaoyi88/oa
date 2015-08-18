<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  财务管理 <span class="c-gray en">&gt;</span> 收款管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
	<form class="Huiform" action="{formatUrl('finance/collect')}" method="post">
  		<div class="text-c">
   			<input nullmsg="搜索信息不可为空！" datatype="s" type="text" class="input-text" style="width:250px" placeholder="输入客户姓名" id="keyword" name="keyword">
    		&nbsp;&nbsp;&nbsp;&nbsp;
    		<button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i> 搜收款</button>
  		</div>
  	</form>
  	{if empty($dataList)}
  		<div class="cl pd-5 bg-1 bk-gray" style="margin:10px 0">
  			<h2 class="text-c">暂无收款</h2>
  		</div>
  	{else}
  		<table class="table table-border table-bordered table-hover table-bg" style="margin:10px 0">
    <thead>
      <tr class="text-c">
      	<th>序号</th>
        <th>订单号</th>
        <th>客户姓名</th>
        <th>收款分类</th>
        <th>金额</th>
        <th>付款方式</th>
        <th>状态</th>
        <th>票据状态</th>
        <th width="300">操作</th>
      </tr>
    </thead>
    <tbody>
      {foreach $dataList as $key=>$item}
      <tr class="text-c">
      	<td>{$key+1}</td>
        <td>{$item['order_no']}</td>
        <td>{if isset($item['customer_name'])}{$item['customer_name']}{/if}</td>
        <td>{$order_collection_type[$item['collection_type']]}</td>
        <td>{$item['collection_amount']}</td>
        <td>{if isset($item['payment_type'])}{$order_payment_type[$item['payment_type']]}{/if}</td>
        <td id="collect{$item['collection_id']}">{$order_collection_status[$item['collection_status']]}</td>
        <td>{$order_bill_status[$item['bill_status']]}</td>
        <td>
        	 <a class="btn btn-primary radius" href="{formatUrl('finance/collectdetail?cid=')}{$item['collection_id']}" style="text-decoration:none">详情</a>
        	 {if checkRight('finance_collect') && $item['collection_status'] == 1}&nbsp;&nbsp;<a class="btn btn-primary radius" href="{formatUrl('finance/collection?cid=')}{$item['collection_id']}" href="javascript:;" style="text-decoration:none">收款</a>{/if}
        	 {if checkRight('finance_collect') && $item['collection_status'] == 2 && $item['bill_status'] == 1}&nbsp;&nbsp;<a class="btn btn-primary radius" href="{formatUrl('finance/prncollection?cid=')}{$item['collection_id']}" href="javascript:;" style="text-decoration:none">出票</a>{/if}
             {if checkRight('finance_collect') && $item['collection_status'] == 1}&nbsp;&nbsp;<a class="btn btn-primary radius cancollect" coid="{$item['collection_id']}" href="javascript:;" style="text-decoration:none">取消</a>{/if}
        </td>
      </tr>
      {/foreach}
    </tbody>
    </table>
    {if isset($pageUrl)}{$pageUrl}{/if}
  	{/if}
</div>
<input type="hidden" id="canCollect" value="{formatUrl('finance/cancelCollect')}"></input>
<script type="text/javascript" src="/public/oa_admin/js/finance.js"></script>