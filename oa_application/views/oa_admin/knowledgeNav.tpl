<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i> 系统管理 <span class="c-gray en">&gt;</span> 知识库管理<span class="c-gray en">&gt;</span> 类目管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>


<div class="pd-20">
  <!-- 一级菜单输出 -->
  <div class="text-c">
    <form class="Huiform" method="post" action="" target="_self">
      {foreach $navall as $nav}
        <button type="button" class="btn btn-primary radius chooseOne" value ="{$nav['cat_id']}">
          <!-- <a href="/oa_admin/knowledge/navManagement/{$nav['cat_id']}" class=" icon-pencil"></a>  -->{$nav['cat_name']}
        </button>&nbsp;&nbsp;&nbsp;          
      {/foreach}
      <button type="button" class=" btn btn-link" value ="0">
        <i class="icon-plus"></i><a href="/oa_admin/knowledge/addNav/0">添加顶级菜单</a>
      </button>
    </form>
  </div>
  </br>
  <!-- 2级菜单输出 -->
  {foreach $navall as $nav}
    <div class="text-c showNav" id="two{$nav['cat_id']}" style="display:none">
      <form class="Huiform" method="post" action="" target="_self">
        {foreach $nav['navtwo'] as $show}  
          <span style="margin-top:2cm;">
            <button type="button" class="btn btn-default chooseTwo" value="{$show['cat_id']}"><a href="/oa_admin/knowledge/navManagement/{$show['cat_id']}" class=" icon-pencil"></a>{$show['cat_name']}</button>&nbsp;&nbsp;&nbsp;    
          </span>
        {/foreach}  
          <span style="margin-top:2cm;">
            <button type="button" class="btn btn-link chooseThree" value="{$nav['cat_id']}"><i class="icon-plus"></i><a href="/oa_admin/knowledge/addNav/{$nav['cat_id']}">添加二级类目</a></button>  
          </span>    
      </form>
    </div>
  {/foreach}
  <br/>
  <!-- 3级菜单输出 -->
  {foreach $navthird as $chooseThree}
      <div class="text-c threeChoose" id="third{$chooseThree['id']}" style="display:none" >
      <form class="Huiform" method="post" action="" target="_self">
          {foreach $chooseThree['other'] as $key} 
            <span style="margin-top:2cm;">
              <button type="button" class="btn btn-default nextNav" value="{$key['cat_id']}"><a href="/oa_admin/knowledge/navManagement/{$key['cat_id']}" class=" icon-pencil"></a>{$key['cat_name']}</button>&nbsp;&nbsp;&nbsp;    
            </span>
          {/foreach}  
            <span style="margin-top:2cm;">
              <button type="button" class=" btn btn-link" id="{$chooseThree['id']}"><i class="icon-plus"></i><a href="/oa_admin/knowledge/addNav/{$chooseThree['id']}">添加三级类目</a></button>   
            </span>    
        </form>
    </div>
  {/foreach}
 <!-- 4级菜单输出 -->
  <div class="text-c endnav lastChoose"  style="display:none">
    <div class="Huiform">
      <div id="lastNav">
      <span style="margin-top:2cm;">
        <button type="button" class="btn btn-link" id=""><i class="icon-plus"></i>添加一个四级类目</button>
      </span>
      </div>
     <!--  <span style="margin-top:2cm;">
        <button type="button" class="btn btn-link" id="{$chooseThree['id']}"><i class="icon-plus"></i>
        <a href="/oa_admin/knowledge/addNav/{$chooseThree['id']}">添加一个四级类目</a></button>
      </span> -->
    </div>
  </div>
<script type="text/javascript" src="/public/oa_admin/js/knowledge/knowledgeNav.js"></script>