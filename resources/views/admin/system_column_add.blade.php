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
		<form action="{{url("admin/column")}}" method="post" class="form form-horizontal" id="form-category-add" enctype="multipart/form-data">
			@csrf
			<div id="tab-category" class="HuiTab">
				<div class="tabBar cl"><span>基本设置</span><span>模版设置</span><span>SEO</span></div>
				<div class="tabCon">
					<div class="row cl">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>上级栏目：</label>
						<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
							<select class="select" id="pid" name="pid">
								<option value="0" level="1" >顶级栏目</option>
								{{$html}}
							</select>
							</span> </div>
						<input type="hidden"	id="level" name="level" value="0">
						<div class="col-3"> </div>
					</div>
					<div class="row cl">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>栏目名称：</label>
						<div class="formControls col-xs-8 col-sm-9">
							<input type="text" class="input-text" value="" placeholder="" id="name" name="name">
						</div>
						<div class="col-3"> </div>
					</div>
					<div class="row cl">
						<label class="form-label col-xs-4 col-sm-3">内容类型：</label>
						<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
							<select name="cotegory_id" id="cotegory_id" class="select">
								@foreach (COLUMN_CATEGORY as $val)
									<option value="{{$val['id']}}" >{{$val['name']}}</option>
								@endforeach
							</select>
							</span> </div>
						<div class="col-3"> </div>
					</div>
					<div class="row cl">
						<label class="form-label col-xs-4 col-sm-3">是否可以选择：</label>
						<div class="formControls col-xs-8 col-sm-9 skin-minimal">
							<div class="check-box">
								<input type="checkbox" id="selectable" checked="checked" name="selectable" value="1">
								<label for="selectable">&nbsp;</label>
							</div>
						</div>
						<div class="col-3"> </div>
					</div>
				</div>
				<div class="tabCon">
					<div class="row cl">
						<label class="form-label col-xs-4 col-sm-3">首页模版：</label>
						<div class="formControls col-xs-8 col-sm-9">
							<span class="btn-upload form-group">
							  <input class="input-text upload-url radius" type="text" readonly><a href="javascript:void();" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
							  <input type="file" multiple name="index_page" class="input-file">
							</span>
						</div>
						<div class="col-3"> </div>
					</div>
					<div class="row cl">
						<label class="form-label col-xs-4 col-sm-3">列表页模版：</label>
						<div class="formControls col-xs-8 col-sm-9">
							<span class="btn-upload form-group">
							  <input class="input-text upload-url radius" type="text" readonly><a href="javascript:void();" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
							  <input type="file" multiple name="list_page" class="input-file">
							</span>
						</div>
						<div class="col-3"> </div>
					</div>
					<div class="row cl">
						<label class="form-label col-xs-4 col-sm-3">详情页模版：</label>
						<div class="formControls col-xs-8 col-sm-9">
							<span class="btn-upload form-group">
							  <input class="input-text upload-url radius" type="text" readonly><a href="javascript:void();" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
							  <input type="file" multiple name="show_page" class="input-file">
							</span>
						</div>
						<div class="col-3"> </div>
					</div>
					<div class="row cl">
						<label class="form-label col-xs-4 col-sm-3">每页显示多少条：</label>
						<div class="formControls col-xs-8 col-sm-9">
							<input type="text" class="input-text" value="20" name="limit" style="width:200px;">
						</div>
						<div class="col-3"> </div>
					</div>
				</div>
				<div class="tabCon">
					<div class="row cl">
						<label class="form-label col-xs-4 col-sm-3">关键词：</label>
						<div class="formControls col-xs-8 col-sm-9">
							<input type="text" class="input-text" value="" name="keyword" id="keyword">
						</div>
						<div class="col-3"> </div>
					</div>
					<div class="row cl">
						<label class="form-label col-xs-4 col-sm-3">描述：</label>
						<div class="formControls col-xs-8 col-sm-9">
							<textarea id="describe" name="describe" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符"></textarea>
						</div>
						<div class="col-3"> </div>
					</div>
				</div>
			</div>
			<div class="row cl">
				<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
					<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
				</div>
			</div>
		</form>
	</div>
</article>

<!--_footer 作为公共模版分离出去-->
@include("admin.layouts._footer")
<!--/_footer /作为公共模版分离出去-->


<!--请在下方写此页面业务相关的脚本--> 
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
function submit_form(){
	$("#form-category-add").submit(function(){
        top.location.reload();
	});

}
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});

	$("#tab-category").Huitab({index:0});

    $("#describe").Huitextarealength({
        minlength:10,
        maxlength:200,
        exceed:false
    });

    $("#pid").change(function(){
        var level = $(this).find("option:selected").attr("level");
        $("#level").val(Number(level) +1);
    });
});
</script> 
<!--/请在上方写此页面业务相关的脚本-->