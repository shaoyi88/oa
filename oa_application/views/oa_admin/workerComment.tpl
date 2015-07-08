<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  咨客管理 <span class="c-gray en">&gt;</span> 统计分析 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
  	<br/>
  	{if empty($hospital)}
  		<div class="cl pd-5 bg-1 bk-gray">
  			<h2 class="text-c">无驻点医院</h2>
  		</div>
  	{else}
  	<table class="table table-border table-bordered table-hover table-bg">
    <thead>
      <tr class="text-c">
      	<th>驻点医院</th>
        <th>科室</th>
        <th>护工数量</th>
        <th>综合平均得分</th>
      </tr>
    </thead>
    <tbody>
    {foreach $hospital as $item}
      <tr class="text-c">
      	<td rowspan="{count($nInfo[$item['wb_id']])+1}">{$item['stationary_name']}</td>
        <td>{$nInfo[$item['wb_id']][0]['stationary_name']}</td>
        <td>{if isset($workernum[$nInfo[$item['wb_id']][0]['wb_id']])}{$workernum[$nInfo[$item['wb_id']][0]['wb_id']]}{else}0{/if}</td>
        <td>{if isset($stacom[$nInfo[$item['wb_id']][0]['wb_id']])}{sprintf("%.2f",$stacom[$nInfo[$item['wb_id']][0]['wb_id']]/$comn[$nInfo[$item['wb_id']][0]['wb_id']])}{else}-{/if}</td>
      </tr>
      {foreach $nInfo[$item['wb_id']] as $i=>$n}
      {if $i>0}
      <tr class="text-c">
         <td>{$n['stationary_name']}</td>
         <td>{if isset($workernum[$n['wb_id']])}{$workernum[$n['wb_id']]}{else}0{/if}</td>
         <td>{if isset($stacom[$n['wb_id']])}{sprintf("%.2f",$stacom[$n['wb_id']]/$comn[$n['wb_id']])}{else}-{/if}</td>
      </tr>
      {/if}
      {/foreach}
      <tr class="text-c">
          <th class="text-r">小结</th><td>{if isset($sum[$item['wb_id']])}{$sum[$item['wb_id']]}{else}0{/if}</td><td>{if isset($stahos[$item['wb_id']])}{sprintf("%.2f",$stahos[$item['wb_id']]/$comh[$item['wb_id']])}{else}-{/if}</td>
      </tr>
    {/foreach}
      <tr class="text-c">
          <th colspan="2">汇总</th><td>{$total}</td><td>{$totalcom}</td>
      </tr>
  	{/if}
</div>
