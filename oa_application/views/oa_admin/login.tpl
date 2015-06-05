<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link href="{$COMMON_CSS_PATH}lib.css" rel="stylesheet" type="text/css" />
<link href="{$COMMON_CSS_PATH}iconfont.css" rel="stylesheet" type="text/css" />
<link href="{$CSS_PATH}login.css?v={$VERSION}" rel="stylesheet" type="text/css" />
<title>系统登录</title>
</head>
<body>
<div class="header"></div>
<div class="loginWraper">
  <div class="loginBox">
    <form id="loginForm" class="form form-horizontal" action="{formatUrl('login/actionLogin')}" method="post">
      <div class="row cl">
        <label class="form-label col-3"><i class="iconfont">&#xf00ec;</i></label>
        <div class="formControls col-8">
          <input id="userAccount" name="userAccount" type="text" placeholder="账户" class="input-text size-L" nullmsg="请输入账户！" datatype="s">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-3"><i class="iconfont">&#xf00c9;</i></label>
        <div class="formControls col-8">
          <input id="userPassword" name="userPassword" type="password" placeholder="密码" class="input-text size-L" nullmsg="请输入密码！" datatype="s">
        </div>
      </div>
      <div class="row">
        <div class="formControls col-8 col-offset-3">
          <input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
        </div>
      </div>
    </form>
  </div>
</div>
<div class="footer">Copyright XXX</div>
<script type="text/javascript" src="{$COMMON_JS_PATH}jquery.min.js"></script> 
<script type="text/javascript" src="{$COMMON_JS_PATH}lib.js"></script> 
<script type="text/javascript" src="{$COMMON_JS_PATH}Validform_v5.3.2.js"></script>
<script type="text/javascript" src="{$JS_PATH}login.js"></script> 
</body>
</html>