@extends("layouts.main")

@section('header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>文章列表</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/">主页</a>
            </li>
            <li>
                <a>内容管理</a>
            </li>
            <li class="active">
                <strong>分类列表</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
@endsection


@section('main')
<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <div class="ibox-content m-b-sm border-bottom">
        <div class="row">
            <div class="col-sm-9">
                <div class="form-group">
                    <button class="btn btn-w-m btn-info add-content"><i class="fa fa-plus-circle"></i> 添加 </button>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>
                        内容分类列表
                    </h5>
                </div>
                <div class="ibox-content table-responsive">
                    <table style="border: 1px solid #e7eaec;" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th data-toggle="true">ID</th>
                            <th data-toggle="true">分类名称</th>
                            <th data-toggle="true">等级</th>
                            <th data-hide="phone">创建时间</th>
                            <th data-hide="phone">显示</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody id="layer-photos">
                            @if($list)
                                @foreach($list as $key => $item)
                                <tr>
                                    <td class="text-center" data-toggle="true">{{$item->id}}</td>
                                    <td class="left" data-toggle="true"> ├{{str_repeat('──', ($item->level -1))}} {{$item->class_name}}</td>
                                    <td class="text-center" data-hide="phone">{{$item->level}}</td>
                                    <td class="text-center" data-hide="phone">{{$item->created_at}}</td>
                                    @if($item->is_show)
                                        <td class="text-center" data-hide="phone">显示</td>
                                    @else
                                        <td class="text-center" data-hide="phone">隐藏</td>
                                    @endif
                                    <td class="text-center" style="min-width: 230px;">
                                        <button class="btn btn-sm btn-info edit"
                                                data-id="{{$item->id}}">
                                            <i class="fa fa-edit"></i> 编辑
                                        </button>
                                        <button class="btn btn-sm btn-info is_show"
                                                data-title="{{$item->class_name}}"
                                                data-id="{{$item->id}}"
                                                data-status="{{$item->is_del}}">
                                            @if($item->is_show)
                                                <i class="fa fa-minus-circle"></i> 隐藏
                                            @else
                                                <i class="fa fa-window-restore"></i> 显示
                                            @endif
                                        </button>
                                        <button class="btn btn-sm btn-danger del"
                                                data-title="{{$item->class_name}}"
                                                data-id="{{$item->id}}"
                                                data-status="{{$item->is_del}}">
                                            <i class="fa fa-times"></i> 删除
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('pageCss')
<style>
    tr > th {text-align: center;}
    tr > td {vertical-align: middle !important;}
    .left {text-align: left;}
</style>
@endsection

@section('pageJs')
<script>var _token= '{{csrf_token()}}';</script>
<script src="/js/my/content/classify/list.js"></script>
@endsection