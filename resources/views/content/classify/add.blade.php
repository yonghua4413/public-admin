<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加分类</title>
    @include("layouts.public_css")
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    <style>
        body{background-color: #ffffff;}
        #container{max-width: 980px;min-width:375px;margin: 0px auto;}
        .form-horizontal .form-group {margin-right: 0px;margin-left: 0px;}
        .i-checks{float: left;margin-right: 20px;line-height: 27px;}
    </style>
</head>

<body>
<div id="container">
    <form class="form-horizontal" method="post">
        @csrf
        <div class="form-group">
            <label class="col-lg-2 control-label">父级分类</label>
            <div class="col-lg-10">
                <select class="form-control m-b" name="pid">
                    <option value="0">顶级分类</option>
                    @foreach($class_list as $item)
                        <option value="{{$item->id}}"> ├{{str_repeat('──', ($item->level -1))}} {{$item->class_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label">分类名称</label>
            <div class="col-lg-10">
                <input type="text" name="class_name" placeholder="分类名称" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">排序</label>
            <div class="col-lg-10">
                <input type="number" name="sort" value="0" class="form-control" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">是否显示</label>
            <div class="col-lg-4">
                <div class="i-checks"><label> <input type="radio" value="1" name="is_show"> <i></i> 显示 </label></div>
                <div class="i-checks"><label> <input type="radio" checked value="0" name="is_show"> <i></i> 隐藏 </label></div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <button class="btn btn-block btn-outline btn-primary" type="submit"> 保 存 </button>
            </div>
        </div>
    </form>
</div>
@include("layouts.public_js")

<!-- iCheck -->
<script src="/js/plugins/iCheck/icheck.min.js"></script>

<script type="text/javascript" src="/js/my/content/classify/add.js"></script>
</body>
</html>