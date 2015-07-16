<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  财务管理 <span class="c-gray en">&gt;</span> 票据管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
	<form class="Huiform" action="{formatUrl('finance/bill')}" method="post">
  		<div class="text-c">
  		    <select style="width:15%" class="select-box" id="received" name="received">
          	    <option value="">请选择</option>
          		{foreach $hospitalInfo as $item}
      			<option value="{$item['wb_id']}">
      			{$item['stationary_name']}
      			</option>
      			{/foreach}
          	</select>
          	&nbsp;&nbsp;
   			<input type="text" class="input-text" style="width:250px" placeholder="输入领取人姓名" id="keyword" name="keyword">
    		&nbsp;&nbsp;&nbsp;&nbsp;
    		<button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i> 搜票据</button>
  		</div>
  	</form>
  	{if checkRight('bill_add')}
	<div class="cl pd-5 bg-1 bk-gray" style="margin:10px 0">
    	<span class="l">
      		<a class="btn btn-primary radius" href="{formatUrl('finance/addbill')}"><i class="icon-plus"></i>添加</a>
    	</span>
  	</div>
  	{/if}
  	{if empty($dataList)}
  		<div class="cl pd-5 bg-1 bk-gray">
  			<h2 class="text-c">暂无票据</h2>
  		</div>
  	{else}
  		<table class="table table-border table-bordered table-hover table-bg">
    <thead>
      <tr class="text-c">
      	<th>序号</th>
        <th>医院</th>
        <th>领取人</th>
        <th>领取日期</th>
        <th>起始单号</th>
        <th>末尾单号</th>
        <th>数量</th>
        <th>已用数量</th>
        <th>作废数量</th>
        <th width="200">操作</th>
      </tr>
    </thead>
    <tbody>
      {foreach $dataList as $item}
      <tr class="text-c">
      	<td>{$item['bill_id']}</td>
        <td>{$stationary[$item['received']]}</td>
        <td>{$item['receiptor']}</td>
        <td>{date('Y-m-d',$item['received_date'])}</td>
        <td>{$item['bill_no_start']}</td>
        <td>{$item['bill_no_end']}</td>
        <td>{$item['bill_num']}</td>
        <td>{$item['used_num']}</td>
        <td id="bill{$item['bill_id']}"><input id="canceled{$item['bill_id']}" type="text" class="input-text" style="width:60px;text-align:center;" value="{$item['canceled_num']}" onclick="this.value=''"></td>
        <td>
             <a bid="{$item['bill_id']}" class="btn btn-primary radius canbill" title="作废票据" href="javascript:void(0);" style="text-decoration:none;margin-bottom:10px">作废</a>
        	 {if checkRight('bill_del')}&nbsp;&nbsp;<a bid="{$item['bill_id']}" title="删除" href="javascript:;" class="btn btn-primary radius del" style="text-decoration:none;margin-bottom:10px">删除</a>{/if}
        </td>
      </tr>
      {/foreach}
    </tbody>
    </table>
    {if isset($pageUrl)}{$pageUrl}{/if}
  	{/if}
</div>
<input type="hidden" id="delUrl" value="{formatUrl('finance/doDelbill')}"></input>
<input type="hidden" id="canBill" value="{formatUrl('finance/cancelBill')}"></input>
<script type="text/javascript" src="/public/oa_admin/js/finance.js"></script>