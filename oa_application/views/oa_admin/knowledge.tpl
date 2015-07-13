<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i> 系统管理 <span class="c-gray en">&gt;</span> 知识库管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>

<div class="pd-20">
  <!-- 添加内容 -->
  <div class="cl pd-5 bg-1 bk-gray mt-20"> 
    <span class="l"><input class="btn btn-secondary radius add-but" type="button" value="添加新内容"></span>
    <span class="r"></span>
  </div>
  <div class="pd-20" id="add-detail" style="display:none">
    <div class="form form-horizontal" id="form-user-add">
      <!---一级菜单 -->
      <div class="row cl">
        <label class="form-label col-3"><span class="c-red">*</span>请选择一级标题</label>
        <div class="formControls col-5"> <span class="select-box">
          <select id="select-nav" class="select" size="1" datatype="*" nullmsg="请选择一级标题">
            <option class ="select-type" value="null">请选择分类</option>
            {foreach $navall as $chooseBut}
              <option class ="select-type" value="{$chooseBut['cat_id']}"> {$chooseBut['cat_name']}</option>
            {/foreach}
          </select>
          </span> 
        </div>
        <div class="col-4"> </div>
      </div>
      <!---2级菜单 -->
      {foreach $navall as $chooseTow}
      <div id="choose{$chooseTow['cat_id']}" class="twoChoose" style="display:none" >
        <div class="row cl twoMeno">
          <label class="form-label col-3"><span class="c-red">*</span>请选择二级标题</label>
          <div class="formControls col-5"> <span class="select-box">
            <select  class="selectNavSecond select" size="1" datatype="*" nullmsg="请选择二级标题">
              <option class ="select-type" value="null">请选择分类</option>
              {foreach $chooseTow['navtwo'] as $key}
                <option class ="select-type" value="{$key['cat_id']}"> {$key['cat_name']}</option>
              {/foreach}
            </select>
            </span> 
          </div>
          <div class="col-4"> </div>
        </div>
      </div>
      {/foreach}
      <!-- 3级菜单 -->
      {foreach $navthird as $chooseThree}
      <div id="other{$chooseThree['id']}" class="threeChoose" style="display:none" >
        <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>请选择下级标题</label>
          <div class="formControls col-5"> <span class="select-box">
            <select id="select-nav" class="select selectNavTree" size="1" datatype="*" nullmsg="请选择下级标题">
              <option class ="select-type" value="null">请选择下级标题</option>
              {foreach $chooseThree['other'] as $key}
                <option class ="select-type" value="{$key['cat_id']}"> {$key['cat_name']}</option>
              {/foreach}
            </select>
            </span> 
          </div>
          <div class="col-4"> </div>
        </div>
      </div>
      {/foreach}
      <!-- 最后 -->
      <div id="" class="lastChoose" style="display:none" >
        <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>请选择下级标题</label>
          <div class="formControls col-5"> 
          <span class="select-box">
            <select id="lastNav" class="select selectNavTree" size="1" datatype="*" nullmsg="请选择下级标题">
              <option class ="select-type" value="null">请选择下级标题</option>
            </select>
            </span> 
          </div>
          <div class="col-4"> </div>
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-3"><span class="c-red">*</span>信息标题</label>
        <div class="formControls col-5"> 
          <input type="text" id="addContentTitle" placeholder="空制在80个汉字，160个字符以内" class="input-text">
        </div>
        <div class="col-4"> </div>
      </div>
      <!-- aother -->
      <div class="row cl">
        <label class="form-label col-3">详细信息</label>
        <div class="formControls col-5">
          <textarea cols="" rows="" class="textarea AddContentDetail" style="height:300px" placeholder="说点什么...最少输入10个字符" datatype="*10-1000" dragonfly="true" nullmsg="详细信息不能为空哦！" onKeyUp="textarealength(this,1000)"></textarea>
          <p class="textarea-numberbar"><em class="textarea-length">0</em>/1000</p>
        </div>
        <div class="col-4"> </div>
      </div>
      <div class="row cl">
        <div class="col-9 col-offset-3">
          <input class="btn btn-primary radius" type="submit" id="addNewcontent" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
        </div>
      </div>
    </div>
  </div>
  <!-- end  -->
<div class="pd-20">
  <!-- 一级菜单输出 -->
  <div class="text-c">
    <div class="Huiform" method="post" action="" target="_self">
      {foreach $navall as $nav}
        <button type="button" class="btn btn-primary radius oneNav" value ="{$nav['cat_id']}" style="line-height:1.6em;margin-top:3px">
        <i class="icon-plus"></i> {$nav['cat_name']}</button>&nbsp;&nbsp;&nbsp;          
      {/foreach}
    </div>
  </div></br>
  <!-- 2级菜单输出 -->
  {foreach $navall as $nav}
  <div class="text-c showtwoNav" id="ww{$nav['cat_id']}" style="display:none">
    <div class="Huiform">
      {foreach $nav['navtwo'] as $eee}  
        <span style="margin-top:2cm;"><button type="button" class="btn btn-secondary radius but-one" id="{$eee['cat_id']}" style="line-height:1.6em;margin-top:3px">
        {$eee['cat_name']}</button>&nbsp;&nbsp;&nbsp;    </span>
        {/foreach}      
    </div>
  </div>
  {/foreach}
  <br/>
  <!-- 3级菜单输出 -->
  <div class="text-c" id="shownavThird">
    <div class="Huiform"><span style="margin-top:2cm;"></span></div>
  </div>

   <!-- 4级菜单输出 -->
  <div class="text-c" id="nav-four">
    <div class="Huiform">
      <span style="margin-top:2cm;"></span>
    </div>
  </div>
</div>
<!-- 所有信息列表 -->
  <table class="table table-border table-bordered table-bg">
    <thead>
      <tr>
        <th scope="col" colspan="7">详细信息</th>
      </tr>
      <tr class="text-c">
        <th width="25"><input type="checkbox" name="" value=""></th>
        <th width="40">ID</th>
        <th width="150">标题</th>
        <th>内容</th>
        <th width="130">最新修改时间</th>
        <th width="100">排序号</th>
        <th width="70">操作</th>
      </tr>
    </thead>
    <tbody id ="knowledgeValue">
      <!-- <tr class="text-c" >
        <td><input type="checkbox" value="2" name=""></td>
        <td>2</td>
        <td>zhangsan</td>
        <td>栏目编辑</td>
        <td>2014-6-11 11:11:42</td>
        <td class="admin-status"><span class="label radius">已停用</span></td>
        <td class="f-14 admin-manage"> 
          <a title="编辑" href="" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a><a title="删除" href="" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a>
        </td>
      </tr> -->
    </tbody>
  </table>
</div>

<script type="text/javascript" src="/public/oa_admin/js/knowledge/knowledge.js"></script>
