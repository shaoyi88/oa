<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  咨客管理  <span class="c-gray en">&gt;</span> <a href="{formatUrl('customerservice/record')}">客服问题</a><span class="c-gray en">&gt;</span> {$typeMsg}</nav>
<div class="pd-20">
  <table class="table table-bg table-border table-bordered">
    <tbody>
      <tr>
        <th class="text-r" width="120">工单号：</th>
        <td>{$info['cs_no']}</td>
      </tr>
      <tr>
        <th class="text-r" width="120">记录人：</th>
        <td>{$info['added_by']}</td>
      </tr>
      <tr>
      	<th class="text-r" width="120">记录时间：</th>
        <td>{date('Y-m-d H:i:s',$info['added_time']+8*3600)}</td>
      </tr>
      <tr>
       <th class="text-r" width="120">客户姓名：</th>
        <td>{if isset($info['cs_user_name'])}{$info['cs_user_name']}{/if}</td>
      </tr>
      <tr>
        <th class="text-r" width="120">客户手机：</th>
        <td>{$info['cs_user_phone']}</td>
      </tr>
      <tr>
      	<th class="text-r" width="120">问题类型：</th>
        <td>{$cstype[$info['cs_type']]}</td>
      </tr>
      {if $info['cs_user_order']}
      <tr>
        <th class="text-r" width="120">相关订单：</th>
        <td>
            <table class="table table-bg table-border table-bordered">
              <tbody>
                <tr class="text-c">
                  <th>订单编号</th>
      	          <th>客户名字</th>
                  <th>服务类型</th>
                  <th>服务模式</th>
                  <th>收费</th>
                  <th>开始时间</th>
                  <th>截至时间</th>
                  <th>预收款</th>
                  <th>费用总额</th>
                  <th>订单状态</th>
                </tr>
                <tr class="text-c">
                  <td><a class="c-primary" title="详情" href="{formatUrl('order/detail?oid=')}{$info['cs_user_order']}"><u class="c-primar">{$info['orderinfo']['order_no']}</u></a></td>
      	          <td>{$info['orderinfo']['customer_name']}</td>
                  <td>{if $info['orderinfo']['service_type']}{$serviceTypeInfo[$info['orderinfo']['service_type']]}{else}暂无{/if}</td>
                  <td>{$order_service_mode[$info['orderinfo']['service_mode']][0]}</td>
                  <td>{$info['orderinfo']['order_fee']}元/{$order_fee_unit[$info['orderinfo']['order_fee_unit']]}</td>
                  <td>{date('Y-m-d H:i:s',$info['orderinfo']['order_start_time'])}</td>
                  <td>{if $info['orderinfo']['order_end_time']}{date('Y-m-d H:i:s',$info['orderinfo']['order_end_time'])}{else}未结束{/if}</td>
                  <td>{if $info['orderinfo']['order_advance_payment']}{$info['orderinfo']['order_advance_payment']}元{else}暂无{/if}</td>
                  <td>{if $info['orderinfo']['order_total_cost']}{$info['orderinfo']['order_total_cost']}元{else}未结算{/if}</td>
                  <td>{$order_status[$info['orderinfo']['order_status']]}</td>
                </tr>
              </tbody>
            </table>
        </td>
      </tr>
      {/if}
      <tr>
      	<th class="text-r" width="120">问题内容：</th>
        <td>{$info['cs_content']}</td>
      </tr>
      <tr>
      	<th class="text-r" width="120">问题状态：</th>
        <td>{$csstatus[$info['cs_status']]}</td>
      </tr>
      {if $info['cs_status']>1}
      <tr>
      	<th class="text-r" width="120">指派给：</th>
        <td>{$info['appointed']}</td>
      </tr>
      <tr>
      	<th class="text-r" width="120">问题处理：</th>
        <td>{$info['cs_treatment']}</td>
      </tr>
      {/if}
    </tbody>
  </table>
</div>
