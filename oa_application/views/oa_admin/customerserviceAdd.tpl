<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  资料管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('customerservice/record')}">客服问题</a> <span class="c-gray en">&gt;</span> {$typeMsg}</nav>
<div class="pd-20">
	<form class="Huiform" id="form-role-add" action="{formatUrl('customerservice/doAdd')}" method="post">
		{if isset($info)}
		<input name="id" type="hidden" value="{$info['id']}">
		{/if}
		<table class="table table-border table-bordered table-bg">
      		<tbody>
      		    {if isset($info)}
      		    <tr>
      		         <th class="text-r" width="80">工单号：</th>
      		         <td>{$info['cs_no']}</td>
      		    </tr>
      		    {/if}
        		<tr>
          		     <th class="text-r" width="80">*用户手机：</th>
          			 <td><input name="cs_user_phone" type="text" class="input-text" id="cs_user_phone" value="{if isset($info)}{$info['cs_user_phone']}{/if}" nullmsg="手机不能为空！" datatype="m"></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">*问题类型：</th>
          			 <td>
          			    <select class="select" id="cs_type" name="cs_type" nullmsg="类型不能为空！" datatype="*">
      						<option value="">请选择类型</option>
      						{foreach $cstype as $key => $item}
      						<option value="{$key}" {if isset($info) && $info['cs_type'] == $key}selected{/if}>
      						{$item}
      						</option>
      						{/foreach}
    					</select>
          			 </td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">*问题内容：</th>
          			 <td><input name="cs_content" class="input-text" id="cs_content" type="text" value="{if isset($info)}{$info['cs_content']}{/if}" nullmsg="内容不能为空！" datatype="*"></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">指派给：</th>
          			 <td>
          			    <select class="select" id="appointed" name="appointed" >
      						<option value="">请选择指派给</option>
      						{foreach $cslist as $item}
      						<option value="{$item['admin_name']}" {if isset($info) && $info['appointed'] == $item['admin_name']}selected{/if}>
      						{$item['admin_name']}
      						</option>
      						{/foreach}
    					</select>
          			 </td>
        		</tr>
        		{if isset($info)}
        		{if $info['cs_status']>1}
        		<tr>
          		     <th class="text-r" width="80">处理问题：</th>
          			 <td><input name="cs_treatment" class="input-text" id="cs_treatment" type="text" value="{$info['cs_treatment']}" ></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">问题状态：</th>
          			 <td>
          			    <select class="select" id="cs_status" name="cs_status" >
      						{foreach $csstatus as $key=>$item}
      						{if $key>1}
      						<option value="{$key}" {if $info['cs_status'] == $key}selected{/if}>
      						{$item}
      						</option>
      						{/if}
      						{/foreach}
    					</select>
          			 </td>
        		</tr>
        		{else}
        		<tr>
          		     <th class="text-r" width="80">问题状态：</th>
          			 <td>未指派<input type="hidden" name="cs_status" value="1"></td>
        		</tr>
        		{/if}
        		<tr>
      		         <th class="text-r" width="80">记录人：</th>
      		         <td>{$info['added_by']}</td>
      		    </tr>
      		    <tr>
      		         <th class="text-r" width="80">记录时间：</th>
      		         <td>{date('Y-m-d H:i:s',$info['added_time']+8*3600)}</td>
      		    </tr>
        		{/if}
          		<tr>
          			<th></th>
          			<td>
            			<button type="submit" class="btn btn-success radius"><i class="icon-ok"></i> {$typeMsg}</button>
          			</td>
        		</tr>
      		</tbody>
      	</table>
	</form>
</div>
<script type="text/javascript" src="/public/common/js/hogan-2.0.0.min.js"></script>
<script type="text/javascript" src="/public/oa_admin/js/customerservice.js"></script>