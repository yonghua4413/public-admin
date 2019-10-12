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
                    <strong>文章列表</strong>
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
                <form>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" name="title" value="{{$title}}" placeholder="请输入标题" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <select name="push_id" class="form-control">
                                <option value="0" selected="">请选择发布机构</option>
                                @foreach($push_list as $item)
                                    @if($push_id == $item->id)
                                        <option value="{{$item->id}}" selected>{{$item->push_name}}</option>
                                    @else
                                        <option value="{{$item->id}}">{{$item->push_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <button type="submit" class="btn btn-w-m btn-primary"><i class="fa fa-search"></i> 搜 索 </button>
                        </div>
                    </div>
                    <div class="col-sm-7 hidden-xs">
                        <div class="form-group" style="float: right;margin-right: 0px;">
                            <button class="btn btn-w-m btn-info add-content"><i class="fa fa-plus-circle"></i> 发 布 </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content table-responsive">
                        <table style="border: 1px solid #e7eaec;" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th data-toggle="true">ID</th>
                                    <th data-toggle="true">标题</th>
                                    <th data-toggle="true">分类</th>
                                    <th data-toggle="true">发布机构</th>
                                    <th data-hide="phone">缩略图</th>
                                    <th data-hide="phone">创建时间</th>
                                    <th data-hide="phone,tablet">发布时间</th>
                                    <th data-hide="phone">推荐</th>
                                    <th data-hide="phone">显示</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody id="layer-photos">
                                @foreach($builder->items() as $key => $item)
                                <tr>
                                    <td class="text-center" data-toggle="true">{{$item->id}}</td>
                                    <td class="text-center" data-toggle="true">{{$item->title}}</td>
                                    <td class="text-center" data-toggle="true">{{$item->class_name}}</td>
                                    <td class="text-center" data-toggle="true">{{$item->push_name}}</td>
                                    <td class="text-center" data-hide="phone">
                                        <img style="width: 25px;height: 25px;" src="{{$item->cover_img}}">
                                    </td>
                                    <td class="text-center" data-hide="phone">{{$item->created_at}}</td>
                                    <td class="text-center" data-hide="phone">{{$item->push_time}}</td>
                                    <td class="text-center" data-hide="phone">{{$item->is_recommend_text}}</td>
                                    <td class="text-center" data-hide="phone">{{$item->is_show_text}}</td>
                                    <td class="text-center" style="min-width: 230px;">
                                        <button class="btn btn-sm btn-success preview" data-id="{{$item->id}}">
                                            <i class="fa fa-search"></i>预览
                                        </button>
                                        <button class="btn btn-sm btn-info edit" data-id="{{$item->id}}">
                                            <i class="fa fa-edit"></i> 编辑
                                        </button>
                                        <button class="btn btn-sm btn-danger del" data-title="{{$item->title}}" data-id="{{$item->id}}">
                                            <i class="fa fa-times"></i> 删除
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="ibox-content text-center">
                        {{$builder->appends(['title' => $title, 'push_id'=> $push_id])->links()}}
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
    </style>
@endsection

@section('pageJs')
    <script>var _token= '{{csrf_token()}}';</script>
    <script src="/js/my/content/list.js"></script>
@endsection