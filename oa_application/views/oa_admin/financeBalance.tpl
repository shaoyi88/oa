<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  财务管理 <span class="c-gray en">&gt;</span> 对账管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
	<form class="Huiform" action="{formatUrl('finance/balance')}" method="post">
  		<div class="text-c">
  		    <select target="worker_stationary" style="width:15%" class="select-box" id="worker_hospital" name="worker_hospital">
          	    <option value="">请选择驻点</option>
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
          	<select style="width:15%" class="select-box" id="salary_month" name="salary_month">
          		<option value="">请选择月份</option>
          		{foreach $allmonths as $m}
                <option value="{$m}">{$m}</option>
                {/foreach}
          	</select>
          	&nbsp;&nbsp;
   			<input type="text" class="input-text" style="width:15%" placeholder="输入护工姓名" id="keyword" name="keyword">
    		&nbsp;&nbsp;&nbsp;&nbsp;
    		<button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i> 搜护工</button>
  		</div>
  	</form>
  	{if checkRight('worker_add')}
	<div class="cl pd-5 bg-1 bk-gray" style="margin:10px 0">
    	<span class="l">
      		<a class="btn btn-primary radius" href="{formatUrl('worker/add')}"><i class="icon-plus"></i>添加</a>
    	</span>
  	</div>
  	{/if}
  	{if empty($dataList)}
  		<div class="cl pd-5 bg-1 bk-gray">
  			<h2 class="text-c">暂无数据</h2>
  		</div>
  	{else}
  		<table class="table table-border table-bordered table-hover table-bg">
    <thead>
      <tr class="text-c">
      	<th>医院</th>
        <th>姓名</th>
        <th>月份</th>
        <th>工资额</th>
        <th width="105">操作</th>
      </tr>
    </thead>
    <tbody>
      {foreach $dataList as $item}
      <tr class="text-c">
      	<td>{$item['stationary_name']}</td>
        <td>{$item['worker_name']}</td>
        <td>{$item['months']}</td>
        <td>{$item['sumsalary']}</td>
        <td class="f-14">
        	 <a title="详情" href="{formatUrl('finance/balancedetail?wid=')}{$item['worker_id']}&months={$item['months']}" style="text-decoration:none"><i class="icon-list-alt"></i></a>
        </td>
      </tr>
      {/foreach}
    </tbody>
    </table>
    {if isset($pageUrl)}{$pageUrl}{/if}
  	{/if}
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