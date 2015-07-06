<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  咨客管理 <span class="c-gray en">&gt;</span> 工单跟踪 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
	<form class="Huiform" action="{formatUrl('customerservice/trace')}" method="post">
  		<div class="text-c">
  		    <select name="cs_type" class="select-box" style="width:10%">
                <option value="">请选择类型</option>
                {foreach $cstype as $key => $item}
      			<option value="{$key}">
      			{$item}
      			</option>
      			{/foreach}
  		    </select>
  		    &nbsp;&nbsp;
  		    <select name="cssingle" class="select-box" style="width:10%">
                <option value="">请选择客服</option>
                {foreach $cslist as $item}
      			<option value="{$item['admin_name']}">
      			{$item['admin_name']}
      			</option>
      			{/foreach}
  		    </select>
  		    &nbsp;&nbsp;
   			<input type="text" class="input-text" style="width:15%" onfocus="WdatePicker()" name="sdate" placeholder="选择时间段-开始时间">&nbsp;-&nbsp;<input type="text" onfocus="WdatePicker()" name="edate" class="input-text" style="width:15%" placeholder="选择时间段-结束时间">
    		&nbsp;&nbsp;&nbsp;&nbsp;
    		<button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i> 搜问题</button>
  		</div>
  	</form>
  	<br/>
  	{if empty($dataList)}
  		<div class="cl pd-5 bg-1 bk-gray">
  			<h2 class="text-c">无客服问题</h2>
  		</div>
  	{else}
  		<table class="table table-border table-bordered table-hover table-bg">
    <thead>
      <tr class="text-c">
      	<th rowspan="2">客服</th>
      	{foreach $stattype as $item}
        <th colspan="2">{$cstype[$item]}</th>
        {/foreach}
      </tr>
      <tr class="text-c">
      	{foreach $stattype as $item}
        <th>记录</th><th>被指派</th>
        {/foreach}
      </tr>
    </thead>
    <tbody>
      {foreach $stat as $key=>$t}
      <tr class="text-c">
          <td>{$key}</td>
          {foreach $stattype as $item}
          <td>{if isset($t[$item]['add'])}{$t[$item]['add']}{else}0{/if}</td><td>{if isset($t[$item]['app'])}{$t[$item]['app']}{else}0{/if}</td>
          {/foreach}
      </tr>
      {/foreach}
    </tbody>
    </table>

  	{/if}
</div>
<script type="text/javascript" src="/public/oa_admin/js/customerservice.js"></script>
<script type="text/javascript" src="/public/common/js/date/WdatePicker.js"></script>