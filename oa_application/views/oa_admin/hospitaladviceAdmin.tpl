<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  意见跟进管理 <span class="c-gray en">&gt;</span> 跟进人员 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
  	{if empty($dataList)}
  		<div class="cl pd-5 bg-1 bk-gray">
  			<h2 class="text-c">暂无意见跟进人员</h2>
  		</div>
  	{else}
  	<table class="table table-border table-bordered table-hover table-bg">
    <thead>
      <tr class="text-c">
        <th>姓名</th>
        <th>部门</th>
        <th>手机</th>
        <th>待跟进意见建议</th>
      </tr>
    </thead>
    <tbody>
      {foreach $dataList as $item}
      <tr class="text-c">
      	<td>{$item['admin_name']}</td>
        <td>{$dpname[$item['admin_department']]}</td>
        <td>{$item['admin_phone']}</td>
        <td>{if isset($undeal[$item['admin_name']])}{$undeal[$item['admin_name']]}{else}0{/if}</td>
      </tr>
      {/foreach}
    </tbody>
    </table>
  	{/if}
</div>