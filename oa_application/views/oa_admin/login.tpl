<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/public/common/js/html5.js"></script>
<script type="text/javascript" src="/public/common/js/respond.min.js"></script>
<script type="text/javascript" src="/public/common/js/PIE_IE678.js"></script>
<![endif]-->
<link href="/public/common/css/lib.css" rel="stylesheet" type="text/css" />
<link href="/public/common/css/iconfont/iconfont.css" rel="stylesheet" type="text/css" />
<link href="/public/common/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="/public/oa_admin/css/login.css" rel="stylesheet" type="text/css" />
<title>一家依信息管理系统登录</title>
</head>
<body>
{if isset($msg)}
<div class="header">
	<div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
</div>
{/if}
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
<div class="footer">Copyright © 一家依信息管理系统</div>
<script type="text/javascript" src="/public/common/js/jquery.min.js"></script> 
<script type="text/javascript" src="/public/common/js/lib.js"></script> 
<script type="text/javascript" src="/public/common/js/Validform_v5.3.2.js"></script>
<script type="text/javascript" src="/public/oa_admin/js/login.js"></script> 
</body>
</html>