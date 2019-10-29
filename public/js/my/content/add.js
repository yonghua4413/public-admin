$(function () {
    <!-- 实例化编辑器 -->
    var ue = UE.getEditor('content');

    var img_accept = {
        title: 'Images',
        extensions: 'gif,jpg,jpeg,bmp,png',
        mimeTypes: 'image/*'
    };
    //实例化图片上传
    upload('upload_img', 'cover_img', img_accept);

    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });

    $('.btn-info').on('click', function (e) {
        if (e && e.preventDefault) {
            e.preventDefault();
            //IE中阻止函数器默认动作的方式
        } else {
            window.event.returnValue = false;
            return false;
        }
    });

    $('#push_time').datetimepicker({
        format: "Y-m-d H:i:s"
    });

    $('.btn-primary').on("click", function (e) {
        if (e && e.preventDefault) {
            e.preventDefault();
            //IE中阻止函数器默认动作的方式
        } else {
            window.event.returnValue = false;
            return false;
        }
        var loading = layer.load(1);
        var data = $('form').serialize();
        $.post("/content/save", data, function (data) {
            layer.close(loading);
            var index = layer.msg(data.message, function () {
                if(data.status == 0){
                    window.parent.location.reload();//刷新父页面
                    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                    parent.layer.close(index);
                    return;
                }
            });

        });
    });

    $('.content-images').on("click", function () {
        layer.open({
            'type':2,
            'title':'浏览图片',
            'area':['30%', '50%'],
            'content':'/'
        });
    });
});
