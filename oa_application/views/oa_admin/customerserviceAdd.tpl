<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  咨客管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('customerservice/record')}">客服问题</a> <span class="c-gray en">&gt;</span> {$typeMsg}</nav>
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
        		<tr id="userphone">
          		     <th class="text-r" width="80">*用户手机：</th>
          			 <td><input name="cs_user_phone" type="text" class="input-text" id="cs_user_phone" value="{if isset($info)}{$info['cs_user_phone']}{/if}" nullmsg="手机不能为空！" datatype="m"></td>
        		</tr>
        		<tr id="username">
          		     <th class="text-r" width="80">用户姓名：</th>
          			 <td><input name="cs_user_name" type="text" class="input-text" id="cs_user_name" value="{if isset($info['cs_user_name'])}{$info['cs_user_name']}{/if}"></td>
        		</tr>
        		{if isset($info)&&$info['cs_user_order']}
                <tr id="orderInfo">
                    <th class="text-r" width="120">相关订单：</th>
                    <td>
                      <table class="table table-bg table-border table-bordered">
                        <tbody>
                          <tr class="text-c">
                              <th>订单编号</th>
      	                      <th>客户名字</th>
                              <th>服务类型</th>
                              <th>服务模式</th>
                              <th>收费</th>
                              <th>开始时间</th>
                              <th>截至时间</th>
                              <th>预收款</th>
                              <th>费用总额</th>
                              <th>订单状态</th>
                          </tr>
                          <tr class="text-c">
                              <td><a class="c-primary" title="详情" href="{formatUrl('order/detail?oid=')}{$info['cs_user_order']}"><u class="c-primar">{$info['orderinfo']['order_no']}</u></a></td>
      	                      <td>{$info['orderinfo']['customer_name']}</td>
                              <td>{if $info['orderinfo']['service_type']}{$serviceTypeInfo[$info['orderinfo']['service_type']]}{else}暂无{/if}</td>
                              <td>{$order_service_mode[$info['orderinfo']['service_mode']][0]}</td>
                              <td>{$info['orderinfo']['order_fee']}元/{$order_fee_unit[$info['orderinfo']['order_fee_unit']]}</td>
                              <td>{date('Y-m-d H:i:s',$info['orderinfo']['order_start_time'])}</td>
                              <td>{if $info['orderinfo']['order_end_time']}{date('Y-m-d H:i:s',$info['orderinfo']['order_end_time'])}{else}未结束{/if}</td>
                              <td>{if $info['orderinfo']['order_advance_payment']}{$info['orderinfo']['order_advance_payment']}元{else}暂无{/if}</td>
                              <td>{if $info['orderinfo']['order_total_cost']}{$info['orderinfo']['order_total_cost']}元{else}未结算{/if}</td>
                              <td>{$order_status[$info['orderinfo']['order_status']]}</td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                </tr>
                {/if}
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
      		         <td>{date('Y-m-d H:i:s',$info['added_time'])}</td>
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
<input type="hidden" id="getUserOrder" value="{formatUrl('customerservice/getUserOrder')}"></input>
<input type="hidden" id="orderDetail" value="{formatUrl('order/detail')}"></input>
<script type="text/javascript" src="/public/common/js/hogan-2.0.0.min.js"></script>
<script type="text/javascript" src="/public/oa_admin/js/customerservice.js?v=102"></script>