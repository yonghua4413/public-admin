$(function () {
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
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
        $.post("/goods/classify/save", data, function (data) {
            layer.close(loading);
            if (data.status == 0) {
                window.parent.location.reload();//刷新父页面
                var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                parent.layer.close(index);
                return;
            }
            layer.alert(data.message);
        });
    });
});
