<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i> 系统管理 <span class="c-gray en">&gt;</span> 知识库管理<span class="c-gray en">&gt;</span> 类目管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
<div class="pd-20">
  <div class="form form-horizontal" id="form-user-add">
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>内容的标题：</label>
      <div class="formControls col-5">
       <input type="text" class="changeNav input-text" id="{$resoureNav['cat_id']}" value="{$resoureNav['cat_name']}"></input>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>更改所属类别：</label>
        <div class="formControls col-5"> <span class="select-box">
          <select id="changeNtip" class="select changeTop" size="1" datatype="*">
            <option name="0" selected>{$title}(默认的上级目录)</option>
            {foreach $resoureList as $nav}<option name="{$nav['cat_id']}">{$nav['cat_name']}</option>{/foreach}
          </select>
          </span> 
        </div>      
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <div class="col-9 col-offset-3">
        <input class="btn btn-primary radius subValue" type="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">&nbsp;&nbsp;
        <input class="btn btn-primary radius delValue" type="button" value="&nbsp;&nbsp;删除&nbsp;&nbsp;">
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="/public/oa_admin/js/knowledge/knowledgeManage.js"></script>
