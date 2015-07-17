<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  财务管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('finance/collect')}">收款管理</a> <span class="c-gray en">&gt;</span> 收款</nav>
<div class="pd-20">
  <form class="Huiform" id="form-role-add" action="{formatUrl('finance/doCollection')}" method="post">
  <input type="hidden" name="collection_id" id="collection_id" value="{$collectInfo['collection_id']}">
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
        <td>
        <select class="select-box" name="payment_type" id="payment_type" datatype="*">
        <option value="">请选择付款方式</option>
        {foreach $order_payment_type as $k=>$item}
      	<option value="{$k}}">
      	{$item}
      	</option>
      	{/foreach}
        </select>
        </td>
      </tr>
      <tr>
         <th></th>
         <td>
            <button type="submit" class="btn btn-success radius"><i class="icon-ok"></i> {$typeMsg}</button>
         </td>
      </tr>
    </tbody>
  </table>
  </form>
</div>
<script type="text/javascript" src="/public/common/js/hogan-2.0.0.min.js"></script>