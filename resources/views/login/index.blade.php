<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>华欣互动 | 登录</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="navbar-wrapper">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll" style="line-height: 64px;">
                <a href="/"><img style="height:58px;" src="/images/logo-1.png"></a>
            </div>
        </div>
    </nav>
</div>
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name">HX</h1>
        </div>
        <h3>欢迎登录公共管理平台</h3>
        <form class="m-t" role="form" method="post" action="">
            @csrf
            <div class="form-group">
                <input type="text" name="username" value="" class="form-control" placeholder="手机号" required="">
            </div>
            <div class="form-group">
                <input type="password" name="password" value="" class="form-control" placeholder="密码" required="">
            </div>
            <button type="submit" id="TencentCaptcha" data-status="0" class="btn btn-primary block full-width m-b">登录</button>
        </form>
        <p class="m-t">
            <small>Copyright</strong> 华欣互动 &copy; 2018-<?php echo date('Y');?></small>
        </p>
    </div>
</div>


<!-- Mainly scripts -->
<script> var login_app_id = "{{$login_app_id}}"; </script>
<script src="/js/jquery-3.1.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/layer/layer.js"></script>
<script src="https://ssl.captcha.qq.com/TCaptcha.js"></script>
<script src="/js/my/login.js"></script>
</body>

</html>
