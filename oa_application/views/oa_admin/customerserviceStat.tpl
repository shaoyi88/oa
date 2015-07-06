<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  咨客管理 <span class="c-gray en">&gt;</span> 统计分析 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
	<form class="Huiform" action="{formatUrl('customerservice/statistical')}" method="post">
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
  		<div id="csinfo"></div>
  	{/if}
</div>
<script type="text/javascript" src="/public/oa_admin/js/customerservice.js"></script>
<script type="text/javascript" src="/public/common/js/date/WdatePicker.js"></script>
<script type="text/javascript" src="/public/common/js/highcharts.js"></script>
<script type="text/javascript">
$(function(){
    chart("csinfo",{$xy[0]},{$xy[1]});
});
</script>