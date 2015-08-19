<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  资料管理 <span class="c-gray en">&gt;</span> 用户统计分析 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
    <form class="Huiform pd-20" action="{formatUrl('user/stat')}" method="post">
  		<div class="text-c"> 
   			<input nullmsg="搜索信息不可为空！" datatype="n" type="text" class="input-text" style="width:250px" placeholder="输入天数" name="dayNum">
    		&nbsp;&nbsp;&nbsp;&nbsp;
    		<button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i> N天内活跃用户</button>
  		</div>
  	</form>
  	<table class="table table-border table-bordered table-bg">
    	<thead>
      		<tr>
        		<th class="text-c" colspan="2">信息统计</th>
      		</tr>
    	</thead>
    	<tbody>
      		<tr class="text-c">
        		<td width="20%">用户总数</td>
        		<td>{$userCount}</td>
      		</tr>
      		{if isset($userCountDayNum)}
      			<tr class="text-c">
        			<td><font style="color:red">{$dayNum}</font>天内活跃用户总数</td>
        			<td>{$userCountDayNum}</td>
      			</tr>
      		{/if}
    	</tbody>
  	</table>
</div>