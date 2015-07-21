<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i> 驻点医院管理 <span class="c-gray en">&gt;</span> 医院护工 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
  	{if empty($hospitalTree)}
  		<div class="cl pd-5 bg-1 bk-gray">
  			<h2 class="text-c">暂无护工</h2>
  		</div>
  	{else}
	<div class="col-3 dTree" style="width:20%">
		<table class="table table-border table-bg table-bordered table-hover">
      		<tbody>
      			{foreach $hospitalTree as $item}
        		<tr hid="{$item['wb_id']}" {if $item['wb_id'] == $pid}class="active"{/if}><td>{if $item['level'] > 0}{str_repeat('&nbsp', $item['level']*2)}├ {/if}{$item['stationary_name']}<b>&gt;</b></td></tr>
        		{/foreach}
      		</tbody>
    	</table>
	</div>
	<div class="col-9" style="margin-left:2%;width:77%;_display:inline">
		{if empty($workerList)}
			<div class="cl pd-5 bg-1 bk-gray"><h2 class="text-c">该医院/科室下暂无护工</h2></div>
		{else}
		<table class="table table-border table-bg table-bordered table-hover">
			<thead>
        		<tr class="text-c">
        		<th>工号</th>
          		<th>护工名</th>
          		<th>头衔</th>
                <th>手机</th>
                <th>性别</th>
                <th>年龄</th>
                <th>工作经验</th>
        		</tr>
      		</thead>
			<tbody>
				{foreach $workerList as $item}
				    <tr class="text-c">
        				<td>{$item['worker_no']}</td>
        				<td>{$item['worker_name']}</td>
          			    <td>{$title[$item['worker_title']]}</td>
                        <td>{$item['worker_phone']}</td>
                        <td>{$sexInfo[$item['worker_sex']]}</td>
                        <td>{$item['worker_age']}</td>
                        <td>{$item['worker_experience']}</td>
                    </tr>
				{/foreach}
			</tbody>
		</table>
		{/if}
	</div>
	{/if}
</div>
<script type="text/javascript" src="/public/oa_admin/js/hospital.js"></script>
<input type="hidden" id="workerUrl" value="{formatUrl('hospital/worker')}"></input>