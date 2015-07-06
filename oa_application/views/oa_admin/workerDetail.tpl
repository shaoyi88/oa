<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  护工管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('worker/index')}">护工信息管理</a> <span class="c-gray en">&gt;</span> 护工详情</nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="cl pd-20" style=" background-color:#5bacb6">
	{if $workerInfo['worker_icon']}
 		<img class="avatar size-XL l" src="{$workerInfo['worker_icon']}">
 	{else}
 		<img class="avatar size-XL l" src="/public/oa_admin/images/user.png">
 	{/if}
  <dl style="margin-left:80px; color:#fff">
    <dt><span class="f-18">{$workerInfo['worker_name']}</span></dt>
  	<dd class="pt-10 f-12" style="margin-left:0">服务状态：{$workerStatus[$workerInfo['worker_status']]}</dd>
  	<dd class="pt-10 f-12" style="margin-left:0">服务分类：{$worker_service}</dd>
  </dl>
</div>
<div class="pd-20">
  <table class="table table-bg table-border table-bordered">
    <tbody>
      <tr>
        <th class="text-r" width="120">归属：</th>
        <td>{$nInfo[$workerInfo['worker_hospital']]}&nbsp;&nbsp;{$nInfo[$workerInfo['worker_stationary']]}</td>
      </tr>
      <tr>
        <th class="text-r" width="120">头衔：</th>
        <td>{$title[$workerInfo['worker_title']]}</td>
      </tr>
      <tr>
        <th class="text-r" width="120">性别：</th>
        <td>{$sexInfo[$workerInfo['worker_sex']]}</td>
      </tr>
      <tr>
        <th class="text-r">手机：</th>
        <td>{$workerInfo['worker_phone']}</td>
      </tr>
      <tr>
        <th class="text-r">户籍地址：</th>
        <td>{$areasInfo[$workerInfo['worker_domicile_province']]}&nbsp;&nbsp;{$areasInfo[$workerInfo['worker_domicile_city']]}&nbsp;&nbsp;{$areasInfo[$workerInfo['worker_domicile_district']]}&nbsp;&nbsp;{$workerInfo['worker_domicile_address']}</td>
      </tr>
      <tr>
        <th class="text-r" width="120">身份证号：</th>
        <td>{$workerInfo['worker_idnumber']}</td>
      </tr>
      <tr>
        <th class="text-r" width="120">生日：</th>
        <td>{$workerInfo['worker_birthday']}</td>
      </tr>
      <tr>
        <th class="text-r" width="120">年龄：</th>
        <td>{$workerInfo['worker_age']}</td>
      </tr>
      <tr>
        <th class="text-r" width="120">婚姻状况：</th>
        <td>{$marriage[$workerInfo['worker_marriage']]}</td>
      </tr>
      <tr>
        <th class="text-r" width="120">教育状况：</th>
        <td>{$eduInfo[$workerInfo['worker_education']]}</td>
      </tr>
      <tr>
        <th class="text-r" width="120">特点：</th>
        <td>{$workerInfo['worker_characteristic']}</td>
      </tr>
    </tbody>
  </table>
</div>
<script type="text/template" id="areaTpl">
<option value="">请选择</option>
<%#areaList%>
	<option value="<%area_id%>">
	<%area_name%>
	</option>
<%/areaList%>
</script>
<input type="hidden" id="getAreasUrl" value="{formatUrl('areas/getAreas')}"></input>
<script type="text/javascript" src="/public/common/js/date/WdatePicker.js"></script>
<script type="text/javascript" src="/public/common/js/hogan-2.0.0.min.js"></script>
<script type="text/javascript" src="/public/oa_admin/js/worker.js"></script>