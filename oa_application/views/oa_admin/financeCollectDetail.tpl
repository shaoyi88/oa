<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  财务管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('finance/collect')}">收款管理</a> <span class="c-gray en">&gt;</span> 收款详情</nav>
<div class="pd-20">
  <table class="table table-bg table-border table-bordered">
    <tbody>
      <tr>
        <th class="text-r" width="120">订单编号：</th>
        <td><a class="c-primary" title="订单详情" href="{formatUrl('order/detail?oid=')}{$collectInfo['order_id']}">{$collectInfo['order_no']}</a></td>
      </tr>
      <tr>
       <th class="text-r" width="120">客户：</th>
        <td>{if isset($collectInfo['customer_name'])}{$collectInfo['customer_name']}{/if}</td>
      </tr>
      <tr>
        <th class="text-r" width="120">收款分类：</th>
        <td>{$order_collection_type[$collectInfo['collection_type']]}</td>
      </tr>
      <tr>
        <th class="text-r" width="120">金额：</th>
        <td>{$collectInfo['collection_amount']}</td>
      </tr>
      <tr>
      	<th class="text-r" width="120">付款方式：</th>
        <td>{if isset($collectInfo['payment_type'])}{$order_payment_type[$collectInfo['payment_type']]}{/if}</td>
      </tr>
      <tr>
      	<th class="text-r" width="120">状态：</th>
        <td>{$order_collection_status[$collectInfo['collection_status']]}</td>
      </tr>
      <tr>
      	<th class="text-r" width="120">票据状态：</th>
        <td>{$order_bill_status[$collectInfo['bill_status']]}</td>
      </tr>
      <tr>
      	<th class="text-r" width="120">票据单号：</th>
        <td>{if $collectInfo['bill_no']}{$collectInfo['bill_no']}{else}暂无{/if}</td>
      </tr>
      <tr>
      	<th class="text-r" width="120">添加时间：</th>
        <td>{date('Y-m-d H:i:s',$collectInfo['add_time'])}</td>
      </tr>
      <tr>
      	<th class="text-r" width="120">付款时间：</th>
        <td>{if isset($collectInfo['payment_time'])}{date('Y-m-d H:i:s',$collectInfo['payment_time'])}{/if}</td>
      </tr>
    </tbody>
  </table>
</div>
