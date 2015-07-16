{if !$hideTitle}
<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  服务跟踪管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('nursing/planList')}">护理计划管理</a> <span class="c-gray en">&gt;</span> 护理计划详情</nav>
{/if}
<div class="pd-20">
  <table class="table table-bg table-border table-bordered">
    <tbody>
      <tr>
        <th class="text-r" width="120">订单编号：</th>
        <td>{$planInfo['order_no']}</td>
      </tr>
      <tr>
        <th class="text-r" width="120">客户名字：</th>
        <td>{$planInfo['customer_name']}</td>
      </tr>
      <tr>
        <th class="text-r" width="120">护工名字：</th>
        <td>{$planInfo['worker_name']}</td>
      </tr>
      <tr>
        <th class="text-r" width="120">安全问题：</th>
        <td>{$planInfo['safety_problem']}</td>
      </tr>
      <tr>
        <th class="text-r" width="120">能力锻炼：</th>
        <td>{$planInfo['ability_training']}</td>
      </tr>
      <tr>
        <th class="text-r" width="120">营养饮食：</th>
        <td>{$planInfo['nutrition_diet']}</td>
      </tr>
      <tr>
        <th class="text-r" width="120">创建时间：</th>
        <td>{date('Y-m-d H:i:s',$planInfo['add_time'])}</td>
      </tr>
      <tr>
        <th class="text-r" width="120">创建人：</th>
        <td>{$planInfo['admin_name']}</td>
      </tr>
    </tbody>
  </table>
</div>