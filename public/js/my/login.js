/**
 * Created by yonghua on 2019/5/18.
 */
$(function () {
    var captcha = new TencentCaptcha(login_app_id, function (res) {
        $(this).attr('data-status', 1);
        if (res.ret == 0) {
            var _data = {
                _token:$('input[name="_token"]').val(),
                code: res.randstr,
                token: res.ticket,
                username:$('input[name="username"]').val(),
                password:$('input[name="password"]').val()
            };
            var loading = layer.load();
            $.post('/login/doVerify', _data, function (data) {
                layer.close(loading);
                $('#TencentCaptcha').attr('data-status', 0);
                if (data.status == 1) {
                    layer.alert(data.message);
                } else {
                    layer.msg(data.message, {time:1000}, function () {
                        window.location.href = '/';
                    });
                }
            });
        } else {
            $('#TencentCaptcha').attr('data-status', 0);
            layer.alert('验证失败');
        }
    });

    $('#TencentCaptcha').on('click', function (e) {
        if (e && e.preventDefault) {
            e.preventDefault();
            //IE中阻止函数器默认动作的方式
        } else {
            window.event.returnValue = false;
            return false;
        }
        if ($(this).attr('data-status') == 1) {
            return;
        }
        var username = $("input[name='username']").val();
        if (!username) {
            layer.alert('手机号不能为空');
            return;
        }
        var password = $("input[name='password']").val();
        if (!password) {
            layer.alert('密码不能为空');
            return;
        }
        captcha.show();
    });

});
