<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  咨客管理 <span class="c-gray en">&gt;</span> 客服问题 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="pd-20">
	<form class="Huiform" action="{formatUrl('customerservice/record')}" method="post">
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
  		    <select name="cs_status" class="select-box" style="width:10%">
                <option value="">请选择状态</option>
                {foreach $csstatus as $key => $item}
      			<option value="{$key}">
      			{$item}
      			</option>
      			{/foreach}
  		    </select>
  		    &nbsp;&nbsp;
  		    <select name="appointed" class="select-box" style="width:10%">
                <option value="">请选择指派给</option>
                {foreach $cslist as $item}
      			<option value="{$item['admin_name']}">
      			{$item['admin_name']}
      			</option>
      			{/foreach}
  		    </select>
  		    &nbsp;&nbsp;
   			<input type="text" class="input-text" style="width:250px" placeholder="输入用户手机号/工单号" id="keyword" name="keyword">
    		&nbsp;&nbsp;&nbsp;&nbsp;
    		<button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i> 搜问题</button>
  		</div>
  	</form>
  	{if checkRight('customer_service_record')}
	<div class="cl pd-5 bg-1 bk-gray" style="margin:10px 0">
    	<span class="l">
      		<a class="btn btn-primary radius" href="{formatUrl('customerservice/add')}"><i class="icon-plus"></i>添加</a>
    	</span>
  	</div>
  	{/if}
  	{if empty($dataList)}
  		<div class="cl pd-5 bg-1 bk-gray">
  			<h2 class="text-c">暂无客服问题</h2>
  		</div>
  	{else}
  		<table class="table table-border table-bordered table-hover table-bg">
    <thead>
      <tr class="text-c">
      	<th>工单号</th>
        <th>用户电话</th>
        <th>问题类型</th>
        <th>问题内容</th>
        <th>问题处理</th>
        <th>当前状态</th>
        <th>指派给</th>
        <th>记录人</th>
        <th width="130">操作</th>
      </tr>
    </thead>
    <tbody>
      {foreach $dataList as $item}
      <tr class="text-c">
      	<td>{$item['cs_no']}</td>
        <td>{$item['cs_user_phone']}</td>
        <td>{$cstype[$item['cs_type']]}</td>
        <td>{$item['cs_content']}</td>
        <td>{$item['cs_treatment']}</td>
        <td>{$csstatus[$item['cs_status']]}</td>
        <td>{$item['appointed']}</td>
        <td>{$item['added_by']}</td>
        <td class="f-14">
        	 {if $item['cs_status']==1}
        	     {if checkRight('customer_service_record')}
        	     <a title="编辑" href="{formatUrl('customerservice/add?id=')}{$item['id']}" class="btn btn-primary radius" style="text-decoration:none">编辑</a>
        	     {/if}
        	 {elseif $item['cs_status']<4}
        	     {if $item['appointed']==$admin}
        	     <a title="编辑" href="{formatUrl('customerservice/add?id=')}{$item['id']}" class="btn btn-primary radius" style="text-decoration:none">编辑</a>
        	     {/if}
        	 {/if}
        	 {if checkRight('customer_service_record')}&nbsp;&nbsp;<a id="{$item['id']}" title="删除" href="javascript:;" class="btn btn-primary radius del" style="text-decoration:none">删除</a>{/if}
        </td>
      </tr>
      {/foreach}
    </tbody>
    </table>
    {if isset($pageUrl)}{$pageUrl}{/if}
  	{/if}
</div>
<input type="hidden" id="delUrl" value="{formatUrl('customerservice/doDel')}"></input>
<script type="text/javascript" src="/public/oa_admin/js/customerservice.js"></script>