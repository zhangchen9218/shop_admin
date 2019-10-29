@include('admin.layouts._meta')
<article class="page-container">
	<div class="pd-20">
        @if ($errors->any())
            <div class = "Huialert Huialert-danger col-xs-12 col-sm-9 col-sm-offset-2" >
                @foreach ($errors->all() as $error)
                    {{ $error }}<br/>
                @endforeach
            </div>
        @endif
		<form class="form form-horizontal" id="form-template-add" method="post" action="{{url("admin/template/$template->id")}}" enctype="multipart/form-data">
			@csrf
            <input type="hidden" name="_method" value="put">
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>模板类型：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <span class="select-box">
                        <select name="type" class="select">
                            @foreach (COLUMN_CATEGORY as $temp)
                                <option value="{{$temp["id"]}}" @if($temp["id"] == $template->type) selected @endif>{{$temp["name"]}}</option>
                            @endforeach
                        </select>
                    </span>
                </div>
                <div class="col-3"> </div>
            </div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>模板名称：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="{{$template->name}}" placeholder="" id="name" name="name">
				</div>
				<div class="col-3"> </div>
			</div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">缩略图：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <div class="uploader-thum-container">
                        <div id="fileList" class="uploader-list">
                            @if (collect($template->icon)->isNotEmpty())
                                <div id="WU_FILE_0" class="item upload-state-success">
                                    <div class="pic-box">
                                        <img src="{{$template->icon}}" width="100" height="100">
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div id="filePicker">选择图片</div>
                        <input type="hidden" name="icon" id="icon" value="{{$template->icon}}">
                    </div>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">模版：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <span class="btn-upload form-group">
                      <input class="input-text upload-url radius" type="text" readonly placeholder="不选择模板文件则不改变"><a href="javascript:void();" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
                      <input type="file" multiple name="template" class="input-file">
                    </span>
                </div>
                <div class="col-3"> </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">关键词：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$template->keyword}}" name="keyword" id="keyword">
                </div>
                <div class="col-3"> </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">描述：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <textarea id="describe" name="describe" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符">{{$template->describe}}</textarea>
                </div>
                <div class="col-3"> </div>
            </div>
			<div class="row cl">
				<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
					<input class="btn btn-primary radius" onclick="" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
				</div>
			</div>
		</form>
	</div>
</article>

<!--_footer 作为公共模版分离出去-->
@include("admin.layouts._footer")
<!--/_footer /作为公共模版分离出去-->


<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/lib/webuploader/0.1.5/webuploader.min.js"></script>
<link href="/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">

$(function(){
    $("#describe").Huitextarealength({
        minlength:10,
        maxlength:200,
        exceed:false
    });

    $('.skin-minimal input').iCheck({
        checkboxClass: 'icheckbox-blue',
        radioClass: 'iradio-blue',
        increaseArea: '20%'
    });

    $list = $("#fileList"),
        $btn = $("#btn-star"),
        state = "pending",
        uploader;

    var uploader = WebUploader.create({
        auto: true,
        formData:{
            _token:'{{ csrf_token() }}'
        },
        swf: '/lib/webuploader/0.1.5/Uploader.swf',

        // 文件接收服务端。
        server: '{{url("admin/template/upload")}}',

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#filePicker',

        // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
        resize: false,
        // 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        }
    });
    uploader.on( 'fileQueued', function( file ) {
        var $li = $(
            '<div id="' + file.id + '" class="item">' +
            '<div class="pic-box"><img></div>'+
            '<div class="info">' + file.name + '</div>' +
            '<p class="state">等待上传...</p>'+
            '</div>'
            ),
            $img = $li.find('img');
        $list.html( $li );

        // 创建缩略图
        // 如果为非图片文件，可以不用调用此方法。
        // thumbnailWidth x thumbnailHeight 为 100 x 100
        uploader.makeThumb( file, function( error, src ) {
            if ( error ) {
                $img.replaceWith('<span>不能预览</span>');
                return;
            }

            $img.attr( 'src', src );
        }, 100, 100 );
    });
    // 文件上传过程中创建进度条实时显示。
    uploader.on( 'uploadProgress', function( file, percentage ) {
        var $li = $( '#'+file.id ),
            $percent = $li.find('.progress-box .sr-only');

        // 避免重复创建
        if ( !$percent.length ) {
            $percent = $('<div class="progress-box"><span class="progress-bar radius"><span class="sr-only" style="width:0%"></span></span></div>').appendTo( $li ).find('.sr-only');
        }
        $li.find(".state").text("上传中");
        $percent.css( 'width', percentage * 100 + '%' );
    });

    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function( file ,response) {
        $( '#'+file.id ).addClass('upload-state-success').find(".state").text("已上传");
        console.log(response);
        $("#icon").val(response.data);
    });

    // 文件上传失败，显示上传出错。
    uploader.on( 'uploadError', function( file ) {
        $( '#'+file.id ).addClass('upload-state-error').find(".state").text("上传出错");
    });

    // 完成上传完了，成功或者失败，先删除进度条。
    uploader.on( 'uploadComplete', function( file ) {
        $( '#'+file.id ).find('.progress-box').fadeOut();
    });
    uploader.on('all', function (type) {
        if (type === 'startUpload') {
            state = 'uploading';
        } else if (type === 'stopUpload') {
            state = 'paused';
        } else if (type === 'uploadFinished') {
            state = 'done';
        }

        if (state === 'uploading') {
            $btn.text('暂停上传');
        } else {
            $btn.text('开始上传');
        }
    });

    $btn.on('click', function () {
        if (state === 'uploading') {
            uploader.stop();
        } else {
            uploader.upload();
        }
    });

});

</script>
<!--/请在上方写此页面业务相关的脚本-->