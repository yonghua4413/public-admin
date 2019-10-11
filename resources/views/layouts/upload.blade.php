<link rel="stylesheet" type="text/css" href="/js/webupload/webuploader.css" />
<style>
    .upload-area{
        display: block;
        width: 120px;
        height: 34px;
        background: none !important;
    }
    .webuploader-pick{
        width:120px !important;
        height:34px !important;
        line-height: 34px;
    }
</style>
<script charset="UTF-8" src="/js/webupload/webuploader.min.js"></script>
<script type="text/javascript">
    var baseUrl   = "{{env('APP_URL')}}";
    function upload(clickBtn, outputId, accept){
        var loading;
        // 初始化Web Uploader
        var uploader = WebUploader.create({
            // 选完文件后，是否自动上传。
            auto: true,
            // swf文件路径
            swf: '/js/webupload/Uploader.swf',
            // 文件接收服务端。
            server: baseUrl + "/api/upload",
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick:{
                id:$("#"+clickBtn), // id
                multiple: false  // false  单选
            },
            // 只允许选择图片文件。
            accept: accept,
            method:'POST'
        });
        //当有文件添加进来的时候
        uploader.on( 'fileQueued', function( file ) {
            loading = layer.load(1);
        });
        //文件上传成功
        uploader.on( 'uploadSuccess', function( file, res ) {
            layer.close(loading);
            if(res.status == 0){
                $('#'+outputId).attr('value',res.data.url);
                layer.msg(res.message);
                return;
            }
            layer.alert(res.message);
        });
    }
</script>
