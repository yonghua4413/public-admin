$(document).ready(function () {
    $('.del').on('click', function () {
        var id = $(this).attr('data-id');
        var is_del = $(this).attr('data-status') ? 0 : 1;
        var title = $(this).attr('data-title');
        var _data = {
            'id': id,
            'is_del': is_del,
            '_token': _token
        };
        layer.alert("您确认要删除 <span style='color: red;'>" + title + "</span> 吗？", function () {
            $.post("/content/classify/modify", _data, function (data) {
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
        var is_show = $(this).attr('data-status') ? 0 : 1;
        var title = $(this).attr('data-title');
        var status = is_show ? '隐藏' : '显示';
        var _data = {
            'id': id,
            'is_show': is_show,
            '_token': _token
        };
        layer.alert("您确认要" + status + " <span style='color: red;'>" + title + "</span> 吗？", function () {
            $.post("/content/classify/modify", _data, function (data) {
                if (data.status == 0) {
                    layer.msg(data.message, {time: 500}, function () {
                        window.location.reload();
                    });
                    return;
                }
                layer.alert(data.message);
            })
        });
    });
});