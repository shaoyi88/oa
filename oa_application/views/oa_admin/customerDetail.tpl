{if !$hideTitle}
<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  资料管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('customer/index')}">客户健康管理</a> <span class="c-gray en">&gt;</span> 客户详情</nav>
{/if}
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="cl pd-20" style=" background-color:#5bacb6">
 	<img class="avatar size-XL l" src="/public/oa_admin/images/user.png">
  <dl style="margin-left:80px; color:#fff">
    <dt><span class="f-18">{$customerInfo['customer_name']}</span></dt>
  	<dd class="pt-10 f-12" style="margin-left:0">{$sexInfo[$customerInfo['customer_sex']]}({$customerInfo['customer_age']}岁)</dd>
  </dl>
</div>
<div class="pd-20">
  <table class="table table-bg table-border table-bordered">
    <tbody>
      <tr>
        <th class="text-r" width="120">身份证：</th>
        <td>{if $customerInfo['customer_card']}{$customerInfo['customer_card']}{else}暂无{/if}</td>
      </tr>
      <tr>
        <th class="text-r" width="120">常用语言：</th>
        <td>{$customerInfo['customer_language']}</td>
      </tr>
      <tr>
        <th class="text-r" width="120">客户分组：</th>
        <td>{$groupInfo[$customerInfo['customer_type']]}</td>
      </tr>
      {if $customerInfo['customer_type'] == 1}
      <tr>
        <th class="text-r" width="120">家庭地址：</th>
        <td>{$customerInfo['customer_address']}</td>
      </tr>
      {else}
      <tr>
        <th class="text-r" width="120">医院：</th>
        <td>{$hospitalInfo[$customerInfo['customer_hospital']]}</td>
      </tr>
       <tr>
        <th class="text-r" width="120">科室：</th>
        <td>{$hospitalInfo[$customerInfo['customer_hospital_department']]}</td>
      </tr>
       <tr>
        <th class="text-r" width="120">床位：</th>
        <td>{$customerInfo['customer_bed_no']}</td>
      </tr>
      {/if}
      <tr>
        <th class="text-r" width="120">服务分组：</th>
        <td>{$serviceTypeInfo[$customerInfo['customer_service_type']]}</td>
      </tr>
      {if $customerInfo['customer_service_type'] != 4}
      <tr>
        <th class="text-r" width="120">个人评估：</th>
        <td>
        	<table class="table table-bg table-border table-bordered">
        		<tbody>
        			<tr>
        				<th class="text-r" width="120">病情：</th>
        				<td>{$customerInfo['customer_illness']}</td>
      				</tr>
      				<tr>
        				<th class="text-r" width="120">过敏药物或食品：</th>
        				<td>{$customerInfo['customer_allergy']}</td>
      				</tr>
       				<tr>
        				<th class="text-r" width="120">个人特殊嗜好：</th>
        				<td>{$customerInfo['customer_hobby']}</td>
      				</tr>
      				<tr>
        				<th class="text-r" width="120">家庭遗传病史：</th>
        				<td>{$customerInfo['customer_genetic']}</td>
      				</tr>
       				<tr>
        				<th class="text-r" width="120">大小便情况：</th>
        				<td>{$customerInfo['customer_defecate_piss']}</td>
      				</tr>
       				<tr>
        				<th class="text-r" width="120">意识状态：</th>
        				<td>{$customerInfo['customer_state']}</td>
      				</tr>
       				<tr>
        				<th class="text-r" width="120">自理能力：</th>
        				<td>{$customerInfo['customer_selfcare_ability']}</td>
      				</tr>
       				<tr>
        				<th class="text-r" width="120">风险因素：</th>
        				<td>
        					<p><strong>心脑血管:&nbsp;&nbsp;</strong>{$customerInfo['customer_risk_xnxg']}</p>
    						<p><strong>呼吸系统:&nbsp;&nbsp;</strong>{$customerInfo['customer_risk_hxxt']}</p>
    						<p><strong>消化系统:&nbsp;&nbsp;</strong>{$customerInfo['customer_risk_xhxt']}</p>
    						<p><strong>神经系统:&nbsp;&nbsp;</strong>{$customerInfo['customer_risk_sjxt']}</p>
    						<p><strong>其他问题:&nbsp;&nbsp;</strong>{$customerInfo['customer_risk_other']}</p>
        				</td>
      				</tr>
       				<tr>
       		 			<th class="text-r" width="120">服务级别：</th>
        				<td>{if $customerInfo['customer_service_level']}{$serviceLevel1[$customerInfo['customer_service_level']]}{else}暂无评估{/if}</td>
      				</tr>
        		</tbody>
        	</table>
        </td>
       </tr>
      {else}
       <tr>
        <th class="text-r" width="120">个人评估：</th>
        <td>
        	<table class="table table-bg table-border table-bordered">
        		<tbody>
        			 <tr>
        				<th class="text-r" width="120">怀孕周数：</th>
        				<td>{if $customerInfo['customer_pregnant_week']}{$customerInfo['customer_pregnant_week']}{/if}</td>
      				</tr>
       				<tr>
        				<th class="text-r" width="120">分娩方式：</th>
        				<td>{$customerInfo['customer_delivery_mode']}</td>
      				</tr>
       				<tr>
        				<th class="text-r" width="120">服务级别：</th>
        				<td>{if $customerInfo['customer_service_level']}{$serviceLevel2[$customerInfo['customer_service_level']]}{else}暂无评估{/if}</td>
      				</tr>
        		</tbody>
        	</table>
        </td>
       </tr>
      {/if}
      <tr>
        <th class="text-r">关注我的用户：</th>
        <td>
        	{if empty($followInfo)}
        		<p style="font-weight:bolder;margin-bottom:0;">暂无关注我的用户</p>
        	{else}
        		<table class="table table-bg table-border table-bordered">
        			<tbody>
        			{foreach $followInfo as $item}
        				<tr>
        					<td width="70%">
        						{$item['user_name']}_{$item['user_phone']}({$item['relationship']})
        					</td>
        					{if !$hideTitle}
        					<td>
        					{if checkRight('follow_del')}<a class="btn btn-primary radius delFollow" fid="{$item['id']}"  title="删除关注我的用户" href="javascript:;" style="text-decoration:none;height:auto">删除</a>&nbsp;&nbsp;{/if}
        					</td>
        					{/if}
        				</tr>
        			{/foreach}
        			</tbody>
        		</table>
        	{/if}
        	{if checkRight('follow_add') and !$hideTitle}
        		<a class="btn btn-primary radius" id="addFollow" title="增加关注我的用户" href="javascript:;" style="text-decoration:none;margin-top:10px;">点击添加</a>
        	{/if}
        </td>
      </tr>
    </tbody>
  </table>
</div>
<div class="pd-20 text-c" style="display:none" id="addFollowWindow">
	<form id="addFollowForm" action="{formatUrl('follow/doAdd?type=2')}" method="post">
		<input type="hidden" name="customer_id" value="{$cid}" />
		<input type="hidden" name="user_id" id="user_id" value="" />
		<table class="table table-bg table-border table-bordered">
			<tr>
      			<td>*关注我的用户ID/姓名/微信号/昵称/手机：</td>
      			<td>
      				<input type="text" class="input-text" id="user_key" value="" nullmsg="关注我的用户不能为空！" datatype="*" autocomplete="off">
      				<div style="position:relative;">
      					<div class="auto-complete-result"></div>
      				</div>
      			</td>
      		</tr>
      		<tr>
      			<td>*关系：</td>
      			<td><input name="relationship" type="text" class="input-text" id="relationship" value="" nullmsg="关系不能为空！" datatype="s"></td>
      		</tr>
      		<tr>
      			<td colspan="2">
      				<button style="margin-top:10px" type="submit" class="btn btn-success" id="submitAddFollow" name=""><i class="icon-plus"></i>增加关注我的用户</button>
      			</td>
      		</tr>
      	</table>
	</form>
</div>
<script type="text/template" id="userTpl">
<ul>
<%#userList%>
<li uid="<%user_id%>"><%user_name%>_<%user_phone%></li>
<%/userList%>
</ul>
</script>
<input type="hidden" id="getUserUrl" value="{formatUrl('user/getUser')}"></input>
<input type="hidden" id="delFollowUrl" value="{formatUrl('follow/doDel?cid=')}{$cid}"></input>
<script type="text/javascript" src="/public/common/js/hogan-2.0.0.min.js"></script>
<script type="text/javascript" src="/public/oa_admin/js/customer.js"></script>