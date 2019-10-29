@extends('admin.layouts.base')
@section('content')
<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 权限管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<div class="text-c">
				<form class="Huiform" method="get" action="{{url("admin/power")}}" target="_self">
					<input type="text" class="input-text" style="width:250px" placeholder="权限名称" id="keyword" name="keyword" value="{{$keyword}}">
					<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜权限节点</button>
				</form>
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="admin_permission_add('添加权限节点','{{url("admin/power/create")}}')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加权限节点</a></span> <span class="r">共有数据：<strong>{{$powerRes->total()}}</strong> 条</span> </div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg">
					<thead>
						<tr class="text-c">
							<th width="25"><input type="checkbox" name="" value=""></th>
							<th width="40">ID</th>
							<th width="200">权限名称</th>
							<th>字段名</th>
							<th width="100">操作</th>
						</tr>
					</thead>
					<tbody>
					@foreach ($powerRes as $power)
						<tr class="text-c">
							<td><input type="checkbox" value="{{$power->id}}" name="del"></td>
							<td>{{$power->id}}</td>
							<td>{{$power->name}}</td>
							<td>{{$power->field}}</td>
							<td>
								<a title="编辑" href="javascript:;" onclick="admin_permission_edit('权限编辑','{{url("admin/power/$power->id/edit")}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
								<a title="删除" href="javascript:;" onclick="admin_permission_del({{$power->id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				<div class="text-r">
					{{$powerRes->links()}}
				</div>
			</div>
		</article>
	</div>
</section>
@stop

@section('script')
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
/*管理员-权限-添加*/
function admin_permission_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-权限-编辑*/
function admin_permission_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}

/*管理员-权限-删除*/
function datadel(){
    var app_value = [];
    $("input:checkbox[name=del]:checked").each(function(i){
        app_value.push($(this).val());
    });
    admin_permission_del(app_value);
}
/*系统-栏目-删除*/
function admin_permission_del(id){
    layer.confirm('确认删除吗？',function(index){
        $.ajax({
            type: 'POST',
            url:"{{url("admin/power/del")}}",
            data:{id:id,_method:"delete"},
            dataType:"json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                if(data.code == 100){
                    window.location.href="{{url("admin/power")}}";
                }else{
                    layer.msg(data.msg,{icon:5,time:1000});
                }
            }
        });
    });
}
</script>
<!--/请在上方写此页面业务相关的脚本-->
@stop