@include('admin.layouts._meta')
<article class="cl pd-20 page-container">
	<form action="" method="post" class="form form-horizontal" id="form-member-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>用户名：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="name" name="name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>邮箱：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" placeholder="@" name="email" id="email">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">性别：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input name="sex" type="radio" id="sex-1" value="1" checked>
					<label for="sex-1">男</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="sex-2" name="sex" value="0">
					<label for="sex-2">女</label>
				</div>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">手机：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="mobile" name="mobile">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">所在城市：</label>
			<div class="formControls col-xs-4 col-sm-3">
				<span class="select-box">
					<select class="select" size="1" name="province">
						<option value="" selected>请选择</option>
						@foreach ( $provinces as $province)
							<option value="{{$province->id}}">{{$province->name}}</option>
						@endforeach
					</select>
				</span>
			</div>
			<div class="formControls col-xs-4 col-sm-3">
				<span class="select-box">
					<select class="select" size="1" name="city">
						<option value="" selected>请选择</option>
					</select>
				</span>
			</div>
			<div class="formControls col-xs-4 col-sm-3">
				<span class="select-box">
					<select class="select" size="1" name="area">
						<option value="" selected>请选择</option>
					</select>
				</span>
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去-->
@include('admin.layouts._footer')
<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-member-add").validate({
		rules:{
			name:{
				required:true,
				minlength:2,
				maxlength:16
			},
			email:{
				required:true,
				email:true,
			},
			
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type:"post",
				url:"{{url("admin/user")}}",
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

	$('select[name="province"],select[name="city"]').on('change',function(){
		var tag = $(this);
		var id = $(this).val();
		$.ajax({
			//请求方式
			type : "POST",
			//请求地址
			url : "{{url('admin/user/getCityAreas')}}"+'/'+id,

			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			//数据，json字符串
			dataType:"json",
			//请求成功
			success : function(json) {
				var html = "<option value=''>请选择</option>";
				$.each(json,function (k,obj) {
					html += "<option value='"+obj.id+"'>"+obj.name+"</option>";
				});
				if(tag.attr('name') == "province"){
					$('select[name="city"]').html(html);
					$('select[name="area"]').html("<option value=''>请选择</option>");
				}
				if(tag.attr('name') == "city"){
					$('select[name="area"]').html(html);
				}
				//nselect.html(html);
			}
		});
	});
});
</script>
