<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>发布文章</title>
    @include("layouts.public_css")
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" rel="stylesheet">
    <style>
        body{background-color: #ffffff;}
        #container{max-width: 980px;min-width:375px;margin: 0px auto;}
    </style>
</head>

<body>
<div id="container">
    <div class="ibox">
        <div class="ibox-content">
            <div class="text-center article-title">
                <h1>
                    {{$info->title}}
                </h1>
                <span class="text-muted"><i class="fa fa-clock-o"></i> {{date('Y-m-d H:i:s', $info->push_time)}}</span>
            </div>
            {!! htmlspecialchars_decode($info->content) !!}
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <h5>标签:</h5>
                    <button class="btn btn-primary btn-xs" type="button">标签</button>
                </div>
                <div class="col-md-6">
                    <div class="small text-right">
                        <h5>统计:</h5>
                        <i class="fa fa-eye"> </i> {{$info->read}} 查看
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include("layouts.public_js")
</body>
</html>