<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  意见跟进管理 <span class="c-gray en">&gt;</span> 意见管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
	<form class="Huiform" action="{formatUrl('hospitaladvice/advice_list')}" method="post">
  		<div class="text-c">
  		    <select name="advice_status" class="select-box" style="width:10%">
                <option value="">请选择状态</option>
                {foreach $hpstatus as $key => $item}
      			<option value="{$key}">
      			{$item}
      			</option>
      			{/foreach}
  		    </select>
  		    {if checkRight('hospitaladvice_all')}
  		    &nbsp;&nbsp;
  		    <select name="appointed" class="select-box" style="width:10%">
                <option value="">请选择跟进人</option>
                {foreach $hplist as $item}
      			<option value="{$item['admin_name']}">
      			{$item['admin_name']}
      			</option>
      			{/foreach}
  		    </select>
  		    &nbsp;&nbsp;
   			<input type="text" class="input-text" style="width:250px" placeholder="输入发起人姓名" id="keyword" name="keyword">
    		{/if}
    		&nbsp;&nbsp;&nbsp;&nbsp;
    		<button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i> 搜意见建议</button>
  		</div>
  	</form>
  	{if checkRight('hospitaladvice_add')}
	<div class="cl pd-5 bg-1 bk-gray" style="margin:10px 0">
    	<span class="l">
      		<a class="btn btn-primary radius" href="{formatUrl('hospitaladvice/add')}"><i class="icon-plus"></i>添加</a>
    	</span>
  	</div>
  	{/if}
  	{if empty($dataList)}
  		<div class="cl pd-5 bg-1 bk-gray" style="margin:5px 0">
  			<h2 class="text-c">暂无意见建议</h2>
  		</div>
  	{else}
  		<table class="table table-border table-bordered table-hover table-bg" style="margin:5px 0">
    <thead>
      <tr class="text-c">
      	<th>序号</th>
        <th>医院</th>
        <th>科室</th>
        <th>发起人</th>
        <th>意见或建议</th>
        <th>跟进人</th>
        <th>反馈</th>
        <th>当前状态</th>
        <th width="180">操作</th>
      </tr>
    </thead>
    <tbody>
      {foreach $dataList as $k=>$item}
      <tr class="text-c">
      	<td>{$k+1}</td>
        <td>{$nInfo[$item['hospital_id']]}</td>
        <td>{$nInfo[$item['stationary_id']]}</td>
        <td>{$item['admin_name']}</td>
        <td>{$item['advice_content']}</td>
        <td>{$item['appointed']}</td>
        <td>{$item['feedback_content']}</td>
        <td>{$hpstatus[$item['advice_status']]}</td>
        <td class="f-14">
        	 {if $item['advice_status']==1}
        	     {if $adminid==$item['added_by']}
        	     <a title="编辑" href="{formatUrl('hospitaladvice/add?id=')}{$item['advice_id']}" class="btn btn-primary radius" style="text-decoration:none">编辑</a>
        	     {/if}
        	     {if checkRight('hospitaladvice_appoint')}
        	     &nbsp;<a title="指派" href="{formatUrl('hospitaladvice/add?id=')}{$item['advice_id']}&ap=1" class="btn btn-primary radius" style="text-decoration:none">指派</a>
        	     {/if}
        	 {elseif $item['advice_status']==2}
        	     {if $item['appointed']==$admin}
        	     <a title="反馈" href="{formatUrl('hospitaladvice/add?id=')}{$item['advice_id']}" class="btn btn-primary radius" style="text-decoration:none">反馈</a>
        	     {/if}
        	 {/if}
        	 {if checkRight('hospitaladvice_del')}&nbsp;<a id="{$item['advice_id']}" title="删除" href="javascript:;" class="btn btn-primary radius del" style="text-decoration:none">删除</a>{/if}
        </td>
      </tr>
      {/foreach}
    </tbody>
    </table>
    {if isset($pageUrl)}{$pageUrl}{/if}
  	{/if}
</div>
<input type="hidden" id="delUrl" value="{formatUrl('hospitaladvice/doDel')}"></input>
<script type="text/javascript" src="/public/oa_admin/js/hospitaladvice.js"></script>