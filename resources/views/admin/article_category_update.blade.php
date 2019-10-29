@include('admin.layouts._meta')
<article class="page-container">
	<div class="pd-20">
		<form class="form form-horizontal" id="form-category-update" enctype="multipart/form-data">
			@csrf
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类栏目：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="{{$category->name}}" placeholder="" id="name" name="name">
				</div>
				<div class="col-3"> </div>
			</div>
			<div class="row cl">
				<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
					<input class="btn btn-primary radius" onclick="submit_form()" type="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
				</div>
			</div>
		</form>
	</div>
</article>

<!--_footer 作为公共模版分离出去-->
@include("admin.layouts._footer")
<!--/_footer /作为公共模版分离出去-->


<!--请在下方写此页面业务相关的脚本-->

<script type="text/javascript">
function submit_form(){
    $("#form-category-update").ajaxSubmit({
        type:"post",
        url:"{{url("admin/art_category/$category->id")}}",
        dataType:"json",
        data:{"_method":"put"},
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
};
</script>
<!--/请在上方写此页面业务相关的脚本-->