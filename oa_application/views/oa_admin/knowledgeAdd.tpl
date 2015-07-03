<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i> 系统管理 <span class="c-gray en">&gt;</span> 知识库管理<span class="c-gray en">&gt;</span> 添加类目 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
<div class="pd-20">
  <div class="form form-horizontal" id="form-user-add">
    <div class="row cl">
      <label class="form-label col-5">{$cat_name}</label>
    </div>
    <div class="row cl">
      <label class="form-label col-3">新类目名称</label>
      <div class="key_id" id="{$cat_id}"></div>
      <div class="formControls col-5">
        <textarea name="navValue" cols="" rows="" class="textarea" id="{$cat_id}"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="导航栏不能为空" onKeyUp="textarealength(this,100)"></textarea>
        <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <div class="col-9 col-offset-3">
        <input class="btn btn-primary radius" id="addcontent" type="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="/public/oa_admin/js/knowledge/knowledgeManage.js"></script>