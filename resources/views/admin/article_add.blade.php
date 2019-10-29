@include('admin.layouts._meta')
<article class="page-container">
	<form class="form form-horizontal" id="form-article-add">
		<input type="hidden" value="1" id="state" name="state">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>文章标题：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="title" name="title">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类栏目：</label>
			<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select id="column_id" name="column_id" class="select">
					<option value="0">全部栏目</option>
					{{$colList}}
				</select>
				</span> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>文章类型：</label>
			<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select name="category_id" class="select">
					    <option value="0">全部分类</option>
					@foreach ($categorys as $key=>$category)
						<option value="{{$category->id}}">{{$category->name}}</option>
					@endforeach
				</select>
				</span> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">排序值：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="0" placeholder="" id="sort" name="sort">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">关键词：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="key_words" name="key_words">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">文章摘要：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="intro" id="intro" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" ></textarea>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">文章作者：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="author" name="author">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">文章来源：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="source" name="source">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">允许评论：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="check-box">
					<input type="checkbox" id="comment_state" name="comment_state" value="1" checked="checked">
					<label for="comment_state">&nbsp;</label>
				</div>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">使用独立模版：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div id="template_name">默认模板</div>
				<input type="hidden" id="template_id" name="template_id" value="0">
				<button onClick="edit_template('选择模板','{{url("/admin/template/".CATEGORY_ARTICLE_ID."/get_by_type")}}',810,600)" class="btn btn-default radius" type="button">选择模版</button>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">缩略图：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<div class="uploader-thum-container">
					<div id="fileList" class="uploader-list"></div>
					<div id="filePicker">选择图片</div>
					<input type="hidden" name="icon" id="icon" value="">
				</div>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">文章内容：</label>
			<div class="formControls col-xs-8 col-sm-9"> 
				<script id="editor" name="editor" type="text/plain" style="width:100%;height:400px;"></script>
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button onClick="article_save_submit(2);" class="btn btn-primary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存并提交审核</button>
				<button onClick="article_save_submit();"class="btn btn-secondary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存草稿</button>
				<button onClick="removeIframe();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
</article>
<!--_footer 作为公共模版分离出去-->
@include("admin.layouts._footer")
<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/lib/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<link href="/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">

/*模板选择*/
function edit_template(title,url,w,h){
    layer_show(title,url,w,h);
}

function removeIframe(){
    $("#form-article-add").resetForm();
}

function article_save_submit (state = 1){
    $("#state").val(state);
    $("#form-article-add").submit();
}

$("#intro").Huitextarealength({
    minlength:10,
    maxlength:200,
	exceed:false
});
$(function(){
    $("#form-article-add").validate({
        rules:{
            title:{
                required:true,
                minlength:5,
                maxlength:50
            },
            intro:{
                required:true,
            },
            column_id:{
                required:true,
            },
            category_id:{
                required:true,
            },
            key_words:{
                required:true,
                maxlength:100
            },
            source:{
                required:true,
            },
            author:{
                required:true,
            },
            ueditor_textarea_editor:{
                required:true,
            },
			sort:{
                digits:true,
			}
        },
        messages: {
            title: {
                required: "标题为必填",
                minlength: "标题最少5个字",
                maxlength: "标题最多50个字"
            },
            intro:{
                required:"简介必须填写",
            },
            column_id: {
                required: "栏目为必选",
            },
            category_id: {
                required: "分类为必选",
            },
            key_words: {
                required: "关键字为必选，多个以\",\"分割",
            },
            source: {
                required: "来源为必填",
            },
            author: {
                required: "作者为必填",
            },
            ueditor_textarea_editor: {
                required: "内容还没有填写",
            },
        },
        focusCleanup:false,
        success:"valid",
        submitHandler:function(form){
            $(form).ajaxSubmit({
                type:"post",
                url:"{{url("admin/article")}}",
                dataType:"json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(json){
                    if(json.code == 99){
                        $(".Huialert-danger").remove();
                        var html = '<div class = "Huialert Huialert-danger col-xs-12 col-sm-9 col-sm-offset-2" >';
                        $.each(json.msg,function(key,val){
                            html += val+"<br/>";
                        });
                        html += '</div>';
                        $(".page-container").prepend(html);
                    }
                    if(json.code == 100){
                        top.location.reload();
                    }
                }
            });
        }
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
		server: '{{url("/admin/article/upload")}}',
	
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
		$list.append( $li );
	
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
	
	var ue = UE.getEditor('editor');
	
});
</script>
<!--/请在上方写此页面业务相关的脚本-->