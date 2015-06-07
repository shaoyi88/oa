<header class="Hui-header cl"> 
	<a class="Hui-logo l" title="XXX管理系统" href="javascript:;">XXX管理系统</a> 
	<span class="Hui-userbox">
		<span class="c-white">{$userName}</span> 
		<a class="btn btn-danger radius ml-10" href="{formatUrl('home/logout')}" title="退出"><i class="icon-off"></i> 退出</a>
	</span> 
	<a aria-hidden="false" class="Hui-nav-toggle" href="#"></a> 
</header>
<aside class="Hui-aside">
  <input runat="server" id="divScrollValue" type="hidden" value="" />
  {foreach $menus as $item}
  {if checkRight($item['right'])}
  <div class="menu_dropdown bk_2">
    <dl>
      <dt>{$item['module']}<b></b></dt>
      <dd>
        <ul>
          {foreach $item['menu'] as $sItem}
          {if checkRight($sItem[2])}
          <li><a _href="{$sItem[1]}" href="javascript:void(0)">{$sItem[0]}</a></li>
          {/if}
          {/foreach}
        </ul>
      </dd>
    </dl>
  </div>
  {/if}
  {/foreach}
</aside>
<div class="dislpayArrow"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
  <div id="Hui-tabNav" class="Hui-tabNav">
    <div class="Hui-tabNav-wp">
      <ul id="min_title_list" class="acrossTab cl">
        <li class="active"><span title="我的桌面" data-href="{formatUrl('home/welcome')}">我的桌面</span><em></em></li>
      </ul>
    </div>
    <div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="icon-step-backward"></i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="icon-step-forward"></i></a></div>
  </div>
  <div id="iframe_box" class="Hui-article">
    <div class="show_iframe">
      <div style="display:none" class="loading"></div>
      <iframe scrolling="yes" frameborder="0" src="{formatUrl('home/welcome')}"></iframe>
    </div>
  </div>
</section>
<script type="text/javascript" src="{$JS_PATH}admin.js"></script>