<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  财务管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('finance/collect')}">护工对账</a> <span class="c-gray en">&gt;</span> 对账详情</nav>
<div class="pd-20">
  <table class="table table-bg table-border table-bordered">
    <tbody>
      <tr>
        <th class="text-r" width="120">驻点医院：</th>
        <td>{$nInfo[$salaryInfo[0]['worker_hospital']]}&nbsp;>&nbsp;{$nInfo[$salaryInfo[0]['worker_stationary']]}</td>
      </tr>
      <tr>
       <th class="text-r" width="120">护工姓名：</th>
        <td>{$salaryInfo[0]['worker_name']}</td>
      </tr>
      <tr>
        <th class="text-r" width="120">订单信息：</th>
        <td>
         <table class="table table-bg table-border table-bordered">
          <tbody>
            <tr class="text-c">
                <th>订单号</th><th>服务类型</th><th>客户姓名</th><th>开始时间</th><th>结束时间</th><th>计费方式</th><th>工时</th><th>工资额</th>
            </tr>
            {foreach $salaryInfo as $item}
            <tr class="text-c">
                <td><a class="c-primary" title="订单详情" href="{formatUrl('order/detail?oid=')}{$item['order_id']}">{$item['order_no']}</a></td><td>{$order_service_mode[$item['service_type']][0]}</td><td>{$item['customer_name']}</td><td>{date('Y-m-d H:i:s',$item['start_time'])}</td><td>{date('Y-m-d H:i:s',$item['end_time'])}</td><td>{$order_fee_unit[$item['order_fee_unit']]}</td><td>{if $item['order_fee_unit']==1}{round(($item['end_time']-$item['start_time'])/(86400*30),1)}{/if}{if $item['order_fee_unit']==2}{round(($item['end_time']-$item['start_time'])/86400,1)}{/if}{if $item['order_fee_unit']==3}{round(($item['end_time']-$item['start_time'])/3600,1)}{/if}</td><td>{$item['salary']}元</td>
            </tr>
            {/foreach}
          </tbody>
         </table>
        </td>
      </tr>
    </tbody>
  </table>
</div>
