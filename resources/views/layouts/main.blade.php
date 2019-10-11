<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>公共管理后台</title>
    @include("layouts.public_css")
    @yield('pageCss')

</head>

<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span>
                            <img alt="image" style="width: 100%;" src="/images/logo-1.png" />
                        </span>
                    </div>
                    <div class="logo-element">
                        HX+
                    </div>
                </li>
                @include('layouts.menus')
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a data-status="0" class="navbar-minimalize minimalize-styl-2 btn btn-primary show-and-hide" href="#">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">欢迎来到华欣公共管理后台</span>
                    </li>

                    <!--li class="dropdown">
                        @include("layouts.notice")
                    </li-->
                    <li>
                        <a class="login-out" href="javasript:;" data-href="{{route('loginOut')}}">
                            <i class="fa fa-sign-out"></i> 注销
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
        @yield("header")
        <div class="wrapper wrapper-content">
            @yield('main')
        </div>
        @include('layouts.footer')
    </div>
</div>

@include("layouts.public_js")
@yield('pageJs')

<script>
    $(document).ready(function () {

        //主菜单的显示和隐藏
        $('.show-and-hide').attr('data-status', parseInt(localStorage.getItem('showAndHide')));
        if(localStorage.getItem('showAndHide') == 1){
            $('body').addClass('mini-navbar');
        }
        $('.show-and-hide').on('click', function () {
            if($(this).attr('data-status') == 1){
                $(this).attr('data-status', 0);
                localStorage.setItem('showAndHide', 0);
                return;
            }
            $(this).attr('data-status', 1);
            localStorage.setItem('showAndHide', 1);
        });
        //end 主菜单的显示和隐藏

        $('.login-out').on('click', function () {
            var url = $(this).attr('data-href');
            layer.alert('您确认要退出吗？', function () {
                window.location.href = url;
            });
        });
    });
</script>
</body>
</html>
