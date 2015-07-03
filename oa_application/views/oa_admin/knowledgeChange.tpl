<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i> 系统管理 <span class="c-gray en">&gt;</span> 知识库管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
<div class="pd-20">
  {foreach $yjy_info as $contentData}
  <form action="/oa_admin/knowledge/savechangeMsg" method="post" class="form form-horizontal" id="form-user-add">
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>id:</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value=" {$contentData['info_id']}" placeholder="" id="info_id" name="info_id" readonly="readonly">
      </div>
      <div class="col-4"> </div>
    </div>      
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>隶属于：</label>
      <div class="formControls col-5" >
        {foreach $infoTitle as $title}<input type="text" class="input-text" value="{$title['cat_name']}" readonly="readonly">{/foreach}
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>排列的顺序：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="{$contentData['info_order']}">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>上一次修改时间：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="{$contentData['add_time']}" readonly="readonly">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>内容的标题：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="{$contentData['info_title']}" readonly="readonly">
      </div>
      <div class="col-4"> </div>
    </div>


    <div class="row cl">
      <label class="form-label col-3">详细内容：</label>
      <div class="formControls col-5">
        <textarea cols="22" rows="" class="textarea" style="height:500px;" datatype="*10-1500" dragonfly="true" onKeyUp="textarealength(this,1500)">{$contentData['info_detail']}</textarea>
        <p class="textarea-numberbar"></p>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <div class="col-9 col-offset-3">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
      </div>
    </div>
  </form>{/foreach}
</div>