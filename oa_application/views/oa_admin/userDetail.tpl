<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  资料管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('user/index')}">用户信息管理</a> <span class="c-gray en">&gt;</span> 用户详情</nav>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
<div class="cl pd-20" style=" background-color:#5bacb6">
	{if $userInfo['user_icon']}
 		<img class="avatar size-XL l" src="{$userInfo['user_icon']}">
 	{else}
 		<img class="avatar size-XL l" src="/public/oa_admin/images/user.png">
 	{/if}
  <dl style="margin-left:80px; color:#fff">
    <dt><span class="f-18">{if $userInfo['user_nickname']}{$userInfo['user_icon']}{else}暂无昵称{/if}</span></dt>
  	<dd class="pt-10 f-12" style="margin-left:0">微信：{if $userInfo['user_weixin']}{$userInfo['user_weixin']}{else}暂无{/if}</dd>
  </dl>
</div>
<div class="pd-20">
  <table class="table table-bg table-border table-bordered">
    <tbody>
      <tr>
        <th class="text-r" width="120">姓名：</th>
        <td>{$userInfo['user_name']}</td>
      </tr>
      <tr>
        <th class="text-r" width="120">性别：</th>
        <td>{$sexInfo[$userInfo['user_sex']]}</td>
      </tr>
      <tr>
        <th class="text-r">手机：</th>
        <td>{$userInfo['user_phone']}</td>
      </tr>
      <tr>
        <th class="text-r">地区：</th>
        <td>{$areasInfo[$userInfo['user_province']]}&nbsp;&nbsp;{$areasInfo[$userInfo['user_city']]}</td>
      </tr>
      <tr>
        <th class="text-r">最近访问时间：</th>
        <td>{if $userInfo['user_last_visit_time'] != ''}{date('Y-m-d H:i:s',$userInfo['user_last_visit_time'])}{else}暂无{/if}</td>
      </tr>
      <tr>
        <th class="text-r">地址：</th>
        <td>
        	{if empty($addressInfo)}
        		<p style="font-weight:bolder;margin-bottom:0;">暂无地址</p>
        	{else}
        		<table class="table table-bg table-border table-bordered">
        			<tbody>
        			{foreach $addressInfo as $item}
        			<tr>
        				<td width="70%">
        					{$areasInfo[$item['province']]}&nbsp;&nbsp;{$areasInfo[$item['city']]}&nbsp;&nbsp;{$areasInfo[$item['area']]}&nbsp;&nbsp;{$item['address']}
        				</td>
        				<td>
        					{if checkRight('user_address_del')}<a class="btn btn-primary radius delAddress" aid="{$item['address_id']}"  title="删除地址" href="javascript:;" style="text-decoration:none;height:auto">删除</a>&nbsp;&nbsp;{/if}
        					{if checkRight('user_address_add')}{if $item['is_default'] == 0}<a class="btn btn-primary radius setAddressIsDefault" aid="{$item['address_id']}"  title="设为默认" href="javascript:;" style="text-decoration:none;height:auto">设为默认</a>{/if}{/if}
        				</td>
        			</tr>
        			{/foreach}
        			</tbody>
        		</table>
        	{/if}
        	{if checkRight('user_address_add')}
        		<a class="btn btn-primary radius" id="addAddress" title="增加地址" href="javascript:;" style="text-decoration:none;margin-top:10px;">点击添加</a>
        	{/if}
        </td>
      </tr>
      <tr>
        <th class="text-r">红包：</th>
        <td>
        	{if empty($couponInfo)}
        		<p style="font-weight:bolder;margin-bottom:0;">暂无红包</p>
        	{else}
        		<table class="table table-bg table-border table-bordered">
        			<tbody>
        			{foreach $couponInfo as $item}
        			<tr>
        				<td width="70%">
        				红包金额：{$item['coupon_amount']}元&nbsp;&nbsp;使用条件：{if $item['coupon_condition']==0}无限制{else}满{$item['coupon_condition']}元{/if}&nbsp;&nbsp;过期时间：{date('Y-m-d', $item['coupon_expire'])}&nbsp;&nbsp;使用情况：{if $item['has_used'] == 1}已使用{else}未使用{/if}
        				</td>
        				<td>
        				{if checkRight('user_coupon_del')}<a class="btn btn-primary radius delCoupon" cid="{$item['coupon_id']}"  title="删除红包" href="javascript:;" style="text-decoration:none;height:auto">删除</a>&nbsp;&nbsp;{/if}
        				</td>
        			</tr>
        			{/foreach}
        			</tbody>
        		</table>
        	{/if}
        	{if checkRight('user_coupon_add')}
        		<a class="btn btn-primary radius" id="addCoupon" title="增加红包" href="javascript:;" style="text-decoration:none;margin-top:10px;">点击添加</a>
        	{/if}
        </td>
      </tr>
      <tr>
        <th class="text-r">关注的病人：</th>
        <td>
        	{if empty($followInfo)}
        		<p style="font-weight:bolder;margin-bottom:0;">暂无关注病人</p>
        	{else}
        		<table class="table table-bg table-border table-bordered">
        			<tbody>
        			{foreach $followInfo as $item}
        				<tr>
        					<td width="70%">
        						{$item['customer_name']}({$item['relationship']})
        					</td>
        					<td>
        					{if checkRight('user_follow_del')}<a class="btn btn-primary radius delFollow" fid="{$item['id']}"  title="删除关注病人" href="javascript:;" style="text-decoration:none;height:auto">删除</a>&nbsp;&nbsp;{/if}
        					</td>
        				</tr>
        			{/foreach}
        			</tbody>
        		</table>
        	{/if}
        	{if checkRight('user_follow_add')}
        		<a class="btn btn-primary radius" id="addFollow" title="增加关注病人" href="javascript:;" style="text-decoration:none;margin-top:10px;">点击添加</a>
        	{/if}
        </td>
      </tr>
    </tbody>
  </table>
</div>
<div class="pd-20 text-c" style="display:none" id="addFollowWindow">
	<form class="Huiform" action="{formatUrl('follow/doAdd?type=1')}" method="post">
		<input type="hidden" name="user_id" value="{$uid}" />
		<input type="hidden" name="customer_id" id="customer_id" value="" />
		<table class="table table-bg table-border table-bordered">
			<tr>
      			<td>关注病人ID/姓名：</td>
      			<td>
      				<input type="text" class="input-text" id="customer_key" value="" nullmsg="关注病人不能为空！" datatype="*" autocomplete="off">
      				<div style="position:relative;">
      					<div class="auto-complete-result"></div>
      				</div>
      			</td>
      		</tr>
      		<tr>
      			<td>关系：</td>
      			<td><input name="relationship" type="text" class="input-text" id="relationship" value="" nullmsg="关系不能为空！" datatype="s"></td>
      		</tr>
      		<tr>
      			<td colspan="2">
      				<button style="margin-top:10px" type="submit" class="btn btn-success" id="submitAddFollow" name=""><i class="icon-plus"></i>增加关注病人</button>
      			</td>
      		</tr>
      	</table>
	</form>
</div>
<div class="pd-20 text-c" style="display:none" id="addCouponWindow">
	<form class="Huiform" action="{formatUrl('coupon/doAdd')}" method="post">
		<input type="hidden" name="user_id" value="{$uid}" />
		<table class="table table-bg table-border table-bordered">
			<tr>
      			<td>红包金额：</td>
      			<td><input name="coupon_amount" type="text" class="input-text" id="coupon_amount" value="" nullmsg="红包金额不能为空！" datatype="n"></td>
      		</tr>
      		<tr>
      			<td>使用条件(不填写为无限制)：</td>
      			<td><input name="coupon_condition" ignore="ignore" type="text" class="input-text" id="coupon_condition" value="" datatype="n"></td>
      		</tr>
      		<tr>
      			<td>过期时间：</td>
      			 <td><input name="coupon_expire" type="text" class="input-text" id="coupon_expire" value="" nullmsg="过期时间不能为空！" datatype="*"></td>
      		</tr>
      		<tr>
      			<td colspan="2">
      				<button style="margin-top:10px" type="submit" class="btn btn-success" id="" name=""><i class="icon-plus"></i>增加红包</button>
      			</td>
      		</tr>
		</table>
	</form>
</div>
<div class="pd-20 text-c" style="display:none" id="addAddressWindow">
	<form class="Huiform" action="{formatUrl('address/doAdd')}" method="post">
		<input type="hidden" name="user_id" value="{$uid}" />
		<table class="table table-bg table-border table-bordered">
    		<tbody>
      			<tr>
      				<td>所在地区：</td>
        			<td>
        				<select target="city" class="select" id="province" name="province" nullmsg="省份不能为空！" datatype="*">
          					<option value="">请选择</option>	
          					{foreach $provinceInfo as $item}
      							<option value="{$item['area_id']}">
      							{$item['area_name']}
      							</option>
      						{/foreach}
        				</select>
        				<select target="area" class="select" id="city" name="city" nullmsg="市区不能为空！" datatype="*">
          					<option value="">请选择</option>	
          				</select>
          				<select class="select" id="area" name="area" nullmsg="县区不能为空！" datatype="*">
          					<option value="">请选择</option>	
          				</select>
        			</td>
      			</tr>
      			<tr>
      				<td>详细地址：</td>
      				<td><input name="address" type="text" class="input-text" id="address" value="" nullmsg="详细地址不能为空！" datatype="s"></td>
      			</tr>
      			<tr>
      				<td colspan="2"><input type="checkbox" name="is_default" id="is_default">设置为默认地址</td>
      			</tr>
      			<tr>
      				<td colspan="2">
      					<button style="margin-top:10px" type="submit" class="btn btn-success" id="" name=""><i class="icon-plus"></i>增加地址</button>
      				</td>
      			</tr>
      		</tbody>
      	</table>
	</form>
</div>
<script type="text/template" id="areaTpl">
<option value="">请选择</option>	
<%#areaList%>
	<option value="<%area_id%>">
	<%area_name%>
	</option>
<%/areaList%>
</script>
<script type="text/template" id="customerTpl">
<ul>
<%#customerList%>
<li cid="<%customer_id%>"><%customer_name%>(<%customer_age%>岁)</li>
<%/customerList%>
</ul>
</script>
<input type="hidden" id="delFollowUrl" value="{formatUrl('follow/doDel?uid=')}{$uid}"></input>
<input type="hidden" id="delCouponUrl" value="{formatUrl('coupon/doDel?uid=')}{$uid}"></input>
<input type="hidden" id="setAddressIsDefaultUrl" value="{formatUrl('address/setAddressIsDefault?uid=')}{$uid}"></input>
<input type="hidden" id="delAddressUrl" value="{formatUrl('address/doDel?uid=')}{$uid}"></input>
<input type="hidden" id="getAreasUrl" value="{formatUrl('areas/getAreas')}"></input>
<input type="hidden" id="getCustomerUrl" value="{formatUrl('customer/getCustomer')}"></input>
<script type="text/javascript" src="/public/common/js/date/WdatePicker.js"></script>
<script type="text/javascript" src="/public/common/js/hogan-2.0.0.min.js"></script>
<script type="text/javascript" src="/public/oa_admin/js/user.js"></script>