<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  护工管理 <span class="c-gray en">&gt;</span> 服务统计 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
	<form class="Huiform" action="{formatUrl('worker/statis')}" method="post">
  		<div class="text-c">
  		    <select target="worker_stationary" style="width:15%" class="select" id="worker_hospital" name="worker_hospital">
          	    <option value="">请选择</option>
          		{foreach $hospitalInfo as $item}
      			<option value="{$item['wb_id']}">
      			{$item['stationary_name']}
      			</option>
      			{/foreach}
          	</select>
          	&nbsp;
          	<select style="width:15%" class="select" id="worker_stationary" name="worker_stationary">
          		<option value="">请选择</option>
          	</select>
          	&nbsp;
          	<select style="width:15%" class="select" id="worker_status" name="worker_status">
          		<option value="">请选择</option>
          		{foreach $wsInfo as $k=>$item}
      			<option value="{$k}" >
      			{$item}
      			</option>
      			{/foreach}
          	</select>
      		&nbsp;&nbsp;&nbsp;&nbsp;
    		<button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i> 查看</button>
  		</div>
  	</form>
  	<br/>
  	<table class="table table-border table-bordered table-hover table-bg">
    <thead>
      <tr class="text-c">
      	<th>驻点医院</th>
        <th>科室</th>
        <th>服务状态</th>
        <th>数量</th>
      </tr>
    </thead>
    <tbody>
      {foreach $dataList as $item}
      <tr class="text-c">
      	<td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      {/foreach}
    </tbody>
    </table>
</div>
<script type="text/template" id="hospitalTpl">
<option value="">请选择</option>
<%#hospitalList%>
	<option value="<%wb_id%>">
	<%stationary_name%>
	</option>
<%/hospitalList%>
</script>
<input type="hidden" id="getHospitalsUrl" value="{formatUrl('hospital/getDepartment')}"></input>
<script type="text/javascript" src="/public/common/js/hogan-2.0.0.min.js"></script>
<script type="text/javascript" src="/public/oa_admin/js/worker.js"></script>