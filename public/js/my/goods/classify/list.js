$(document).ready(function () {
    $('.del').on('click', function () {
        var id = $(this).attr('data-id');
        var title = $(this).attr('data-title');
        var _data = {
            'id': id,
            'is_del': 1,
            '_token': _token
        };
        layer.alert("您确认要删除 <span style='color: red;'>" + title + "</span> 吗？", function () {
            $.post("/goods/classify/modify", _data, function (data) {
                if (data.status == 0) {
                    layer.msg(data.message, {time: 500}, function () {
                        window.location.reload();
                    });
                    return;
                }
                layer.alert(data.message);
            });
        });
    });

    $('.is_show').on('click', function () {
        var id = $(this).attr('data-id');
        var is_show = parseInt($(this).attr('data-status')) ? 0 : 1;
        var title = $(this).attr('data-title');
        var status = is_show ? '显示' : '隐藏';
        var _data = {
            'id': id,
            'is_show': is_show,
            '_token': _token
        };
        layer.alert("您确认要" + status + " <span style='color: red;'>" + title + "</span> 吗？", function () {
            $.post("/goods/classify/modify", _data, function (data) {
                if (data.status == 0) {
                    layer.msg(data.message, {time: 500}, function () {
                        window.location.reload();
                    });
                    return;
                }
                layer.alert(data.message);
            });
        });
    });

    $('.add-classify').on("click", function () {
        layer.open({
            'title':"添加分类",
            'type': 2,
            'area':['550px', '400px'],
            'content':'/goods/classify/add'
        });
    });

    $('.modify-classify').on("click", function () {
        var id = $(this).attr('data-id');
        var title = $(this).attr('data-title');
        layer.open({
            'title':"编辑分类："+ title,
            'type': 2,
            'area':['550px', '400px'],
            'content':'/goods/classify/edit?id='+id
        });
    });
});