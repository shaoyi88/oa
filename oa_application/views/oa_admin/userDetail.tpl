<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  资料管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('user/index')}">用户信息管理</a> <span class="c-gray en">&gt;</span> 用户详情</nav>
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
        <th class="text-r" width="120">性别：</th>
        <td>{$sexInfo[$userInfo['user_sex']]}</td>
      </tr>
      <tr>
        <th class="text-r">手机：</th>
        <td>{$userInfo['user_phone']}</td>
      </tr>
      <tr>
        <th class="text-r">地区：</th>
        <td>XXX</td>
      </tr>
      <tr>
        <th class="text-r">最近访问时间：</th>
        <td>{if $userInfo['user_last_visit_time'] != ''}{date('Y-m-d H:i:s',$userInfo['user_last_visit_time'])}{else}暂无{/if}</td>
      </tr>
      <tr>
        <th class="text-r">地址：</th>
        <td>XXX</td>
      </tr>
      <tr>
        <th class="text-r">红包：</th>
        <td>XXX</td>
      </tr>
      <tr>
        <th class="text-r">关注的病人：</th>
        <td>XXX</td>
      </tr>
    </tbody>
  </table>
</div>