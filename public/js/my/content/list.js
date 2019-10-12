$(function () {
    $('.preview').on("click", function () {
        var id = $(this).attr('data-id');
        layer.open({
            'type':2,
            'title':"预览",
            'area':['100%', '100%'],
            'content':"/content/preview?id="+id
        });
    });

    $('.edit').on("click", function () {
        var id = $(this).attr('data-id');
        layer.open({
            'type':2,
            'title':"预览",
            'area':['100%', '100%'],
            'content':"/content/edit?id="+id
        });
    });

    $('.del').on("click", function () {
        var id = $(this).attr('data-id');
        var title = $(this).attr('data-title');
        layer.alert("请确认要删除 <span style='color:red;'>" + title + "</span> 吗？",
            {'title':'警告'}, function () {
                var _data = {'_token':_token, 'id':id};
                $.post("/content/del", _data, function (data) {
                    if(data.status == 0){
                        layer.msg(data.message,{'time':1000}, function () {
                            window.location.reload();
                        });
                        return;
                    }
                    layer.alert(data.message);
                });
            }
        );
    });

    $('.add').on('click', function (e) {
        if (e && e.preventDefault) {
            e.preventDefault();
            //IE中阻止函数器默认动作的方式
        } else {
            window.event.returnValue = false;
            return false;
        }
        layer.open({
            'type':2,
            'title':"发布内容",
            'area':['100%', '100%'],
            'content':"/content/add"
        });
    });

    layer.photos({
        photos: '#layer-photos'
        ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
    });
});

$('.add-content').on("click", function (e) {
    if (e && e.preventDefault) {
        e.preventDefault();
        //IE中阻止函数器默认动作的方式
    } else {
        window.event.returnValue = false;
        return false;
    }
    layer.open({
        'title':"发布内容",
        'type':2,
        'area':['100%', '100%'],
        'content':"/content/add"
    });
});
