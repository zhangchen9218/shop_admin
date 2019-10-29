@include('admin.layouts._meta'	)
<article class="cl pd-20">
	<form class="form form-horizontal" id="form-admin-role-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>角色名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$role->name}}" placeholder="" id="name" name="name" datatype="*4-16">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">备注：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$role->describe}}" placeholder="" id="describe" name="describe">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">权限：</label>
			<div class="formControls col-xs-8 col-sm-9">
				@foreach ($list as $power)
				<dl class="permission-list">
					<dt>
						<label>
							<input type="checkbox" @if (in_array($power['id'],$powerIds)) checked="checked" @endif value="{{$power['id']}}"  name="power_ids[]" id="user-Character-0">
							{{$power['name']}}
						</label>
					</dt>
					<dd>
						@foreach ($power['index'] as $val)
						<dl class="cl permission-list2">
							<dt>
								<label class="">
									<input type="checkbox" @if (in_array($val['id'],$powerIds)) checked="checked" @endif value="{{$val['id']}}" name="power_ids[]" id="user-Character-0-0">
									{{$val['name']}}</label>
							</dt>
							<dd>
								@foreach ($val['res'] as $v)
								<label class="">
									<input type="checkbox" value="{{$v['id']}}" @if (in_array($v['id'],$powerIds)) checked="checked" @endif name="power_ids[]" id="user-Character-0-0-0">
									{{$v['name']}}
								</label>
								@endforeach
							</dd>
						</dl>
						@endforeach
					</dd>
				</dl>
				@endforeach
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<button onclick="submit_form()" type="button" class="btn btn-success radius" id="admin-role-save" name="admin-role-save"><i class="icon-ok"></i> 确定</button>
			</div>
		</div>
	</form>
</article>

@include('admin.layouts._footer')

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
function submit_form(){
	$("#form-admin-role-add").ajaxSubmit({
		type:"post",
		url:"{{url("admin/role/{$role->id}")}}",
		dataType:"json",
		data: {"_method":"put"},
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
				$(".pd-20").prepend(html);
			}
			if(json.code == 100){
				top.location.reload();
			}
		}
	});
};
$(function(){
	$(".permission-list dt input:checkbox").click(function(){
		$(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
	});
	$(".permission-list2 dd input:checkbox").click(function(){
		var l =$(this).parent().parent().find("input:checked").length;
		var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
		if($(this).prop("checked")){
			$(this).closest("dl").find("dt input:checkbox").prop("checked",true);
			$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
		}
		else{
			if(l==0){
				$(this).closest("dl").find("dt input:checkbox").prop("checked",false);
			}
			if(l2==0){
				$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
			}
		}
	});

});
</script>
<!--/请在上方写此页面业务相关的脚本-->