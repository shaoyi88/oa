<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  护工管理 <span class="c-gray en">&gt;</span> 服务统计 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
	<form class="Huiform" action="{formatUrl('worker/statis')}" method="post">
  		<div class="text-c">
  		    <select target="worker_stationary" style="width:15%" class="select-box" id="worker_hospital" name="worker_hospital">
          	    <option value="">请选择</option>
          		{foreach $hospitalInfo as $item}
      			<option value="{$item['wb_id']}">
      			{$item['stationary_name']}
      			</option>
      			{/foreach}
          	</select>
          	&nbsp;&nbsp;
          	<select style="width:15%" class="select-box" id="worker_stationary" name="worker_stationary">
          		<option value="">请选择</option>
          	</select>
          	&nbsp;&nbsp;
          	<select style="width:15%" class="select-box" id="worker_status" name="worker_status">
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
      {foreach $staHospital as $item}
      <tr class="text-c">
      	<td rowspan="{count($nInfo[$item['wb_id']])*count($staWs)+1}">{$item['stationary_name']}</td>
        <td rowspan="{count($staWs)}">{$nInfo[$item['wb_id']][0]['stationary_name']}</td>
        <td>{$staWs[0]['ws']}</td>
        <td>{if isset($statInfo[$nInfo[$item['wb_id']][0]['wb_id']][$staWs[0]['wk']])}{$statInfo[$nInfo[$item['wb_id']][0]['wb_id']][$staWs[0]['wk']]}{else}0{/if}</td>
      </tr>
      {foreach $staWs as $k=>$ws}
      {if $k>0}
      <tr class="text-c">
         <td>{$ws['ws']}</td>
         <td>{if isset($statInfo[$nInfo[$item['wb_id']][0]['wb_id']][$ws['wk']])}{$statInfo[$nInfo[$item['wb_id']][0]['wb_id']][$ws['wk']]}{else}0{/if}</td>
      </tr>
      {/if}
      {/foreach}
      {foreach $nInfo[$item['wb_id']] as $i=>$n}
      {if $i>0}
      <tr class="text-c">
         <td rowspan="{count($staWs)}">{$n['stationary_name']}</td>
         <td>{$staWs[0]['ws']}</td>
         <td>{if isset($statInfo[$n['wb_id']][$staWs[0]['ws']])}{$statInfo[$n['wb_id']][$staWs[0]['ws']]}{else}0{/if}</td>
      </tr>
      {foreach $staWs as $k=>$ws}
      {if $k>0}
      <tr class="text-c">
         <td>{$ws['ws']}</td>
         <td>{if isset($statInfo[$n['wb_id']][$ws['wk']])}{$statInfo[$n['wb_id']][$ws['wk']]}{else}0{/if}</td>
      </tr>
      {/if}
      {/foreach}
      {/if}
      {/foreach}
      <tr class="text-c">
          <td class="text-r">小结</td><td>&nbsp;</td><td>{if isset($sum[$item['wb_id']])}{$sum[$item['wb_id']]}{else}0{/if}</td>
      </tr>
      {/foreach}
      <tr class="text-c">
          <th colspan="3">汇总</th><td>{$total}</td>
      </tr>
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