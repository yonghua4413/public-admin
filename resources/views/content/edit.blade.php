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
        #container{max-width: 980px;min-width:375px;margin: 0px auto; margin-top: 20px;}
        .form-group{margin-top: 15px;}
        .form-horizontal .form-group {margin-right: 0px;margin-left: 0px;}
        .i-checks{float: left;margin-right: 20px;line-height: 27px;}
</style>
</head>

<body>
<div id="container">
    <form class="form-horizontal">
        <input type="hidden" name="id" value="{{$info->id}}">
        @csrf
        <div class="form-group">
            <label class="col-lg-2 control-label">内容分类</label>
            <div class="col-lg-10">
                <select class="form-control m-b" name="class_id">
                    <option value="0">未分类</option>
                    @foreach($class as $item)
                        @if($info->class_id == $item->id)
                            <option selected value="{{$item->id}}"> ├{{str_repeat('──', ($item->level -1))}} {{$item->class_name}}</option>
                        @else
                            <option value="{{$item->id}}"> ├{{str_repeat('──', ($item->level -1))}} {{$item->class_name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">发布机构</label>
            <div class="col-lg-10">
                <select class="form-control m-b" name="push_id">
                    <option value="0">默认机构</option>
                    @foreach($push as $item)
                        <option <?php if($info->push_id == $item->id){echo "selected";}?> value="{{$item->id}}">{{$item->push_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">内容标题</label>
            <div class="col-lg-10">
                <input type="text" name="title" placeholder="请输入标题" value="{{$info->title}}" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">关键字</label>
            <div class="col-lg-10">
                <input type="text" name="keywords" placeholder="请输入关键字" value="{{$info->keywords}}" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">封面图</label>
            <div class="col-lg-6">
                <input type="text" id="cover_img" name="cover_img" value="{{$info->cover_img}}" readonly class="form-control">
            </div>
            <div class="col-lg-4">
                <span id="upload_img" style="float: left;" class="upload-area"><i class="fa fa-upload"></i> 上传图片</span>
                <button style="float: left;margin-left: 5px;" class="btn btn-info"><i class="fa fa-file-image-o"></i> 浏览图片</button>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">内容简介</label>
            <div class="col-lg-10">
                <textarea type="text" name="intro" placeholder="请输入简介" class="form-control">{{$info->intro}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">内容详情</label>
            <div class="col-lg-10">
                <script id="content" name="content" type="text/plain">{!! htmlspecialchars_decode($info->content) !!}</script>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">阅读量</label>
            <div class="col-lg-10">
                <input type="number" name="read" value="{{$info->read}}" class="form-control" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">发布时间</label>
            <div class="col-lg-10">
                <input type="text" id="push_time" name="push_time" value="{{date("Y-m-d H:i:s", $info->push_time)}}" class="form-control" />
                <span class="help-block m-b-none">当前时间大于发布时间才能查询到此内容</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">是否推荐</label>
            <div class="col-lg-4">
                <div class="i-checks"><label> <input type="radio" <?php if($info->is_recommend){echo "checked";}?> value="1" name="is_recommend"> <i></i> 推荐 </label></div>
                <div class="i-checks"><label> <input type="radio" <?php if(!$info->is_recommend){echo "checked";}?> value="0" name="is_recommend"> <i></i> 不推荐 </label></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">是否显示</label>
            <div class="col-lg-4">
                <div class="i-checks"><label> <input type="radio" value="1" <?php if($info->is_show){echo "checked";}?> name="is_show"> <i></i> 显示 </label></div>
                <div class="i-checks"><label> <input type="radio" value="0" <?php if(!$info->is_show){echo "checked";}?> name="is_show"> <i></i> 隐藏 </label></div>
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
<!-- Data picker -->
<script src="https://cdn.bootcss.com/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
<script type="text/javascript" src="/js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/js/ueditor/ueditor.all.js"></script>

<!-- iCheck -->
<script src="/js/plugins/iCheck/icheck.min.js"></script>

@include("layouts.upload")
<script type="text/javascript" src="/js/my/content/edit.js"></script>
</body>
</html>