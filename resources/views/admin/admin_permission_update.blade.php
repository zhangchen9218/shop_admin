@include('admin.layouts._meta')
<article class="page-container">
	<div class="pd-20">
		<form class="form form-horizontal" id="form-permission-add" enctype="multipart/form-data">
            <div class="row cl">
                <label class="form-label col-xs-5 col-sm-3"><span class="c-red">*</span>权限名称：</label>
                <div class="formControls col-xs-7 col-sm-8">
                    <input type="text" class="input-text" value="{{$power->name}}" placeholder="" id="name" name="name">
                </div>
                <div class="col-3"> </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-5 col-sm-3">是否为顶级分类：</label>
                <div class="formControls col-xs-7 col-sm-8 skin-minimal">
                    <div class="check-box">
                        <input type="checkbox" id="acme" name="acme" value="1" @if($power->acme) checked="checked" @endif>
                        <label for="acme">&nbsp;</label>
                    </div>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-5 col-sm-3"><span class="c-red">*</span>所属功能：</label>
                <div class="formControls col-xs-7 col-sm-8 ">
                    <div class="select-box">
                        <select name="belong_to" id="belong_to" class="select" @if($power->acme) disabled @endif>
                            @if($power->acme)
                                <option value="0">顶级分类</option>
                            @endif
                            @foreach ($acmeRes as $acme)
                                <option value="{{$acme->id}}" @if($power->belong_to == $acme->id) selected="selected" @endif>{{$acme->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-3"> </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-5 col-sm-3"><span class="c-red">*</span>路由名称：</label>
                <div class="formControls col-xs-7 col-sm-8">
                    <textarea id="field" name="field" class="textarea radius">{{$power->field}}</textarea>
                </div>
                <div class="col-3"> </div>
            </div>
            <div class="row cl">
                <div class="col-xs-7 col-sm-8 col-xs-offset-5 col-sm-offset-3">
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
    $("#form-permission-add").ajaxSubmit({
        type:"post",
        url:"{{url("admin/power/$power->id")}}",
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
$(function(){
    $("#acme").change(function (){
        if($(this).is(":checked")){
            $("#belong_to").prepend("<option value='0'>顶级分类</option>");
            $("#belong_to option:first").prop("selected","selected");
            $("#belong_to").attr("disabled",true);
        }else{
            $("#belong_to option:first").remove();
            $("#belong_to").removeAttr("disabled");
        }
    });
});
</script>
<!--/请在上方写此页面业务相关的脚本-->