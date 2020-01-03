﻿@extends('admin.layouts.base')
@section('content')
<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
		<span class="c-gray en">&gt;</span>
		管理员管理
		<span class="c-gray en">&gt;</span>
		管理员列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a> </nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<form action="{{url('admin/adn')}}" method="get">
				<div class="text-c">
					<input type="text" class="input-text" style="width:250px" placeholder="输入管理员姓名" id="key_word" name="key_word">
					<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
				</div>
			</form>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l">
					<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
					<a href="javascript:;" onclick="admin_add('添加管理员','{{url("/admin/adn/create")}}','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加管理员</a>
				</span>
				<span class="r">共有数据：<strong>{{$adminRes->total()}}</strong> 条</span>
			</div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg">
					<thead>
						<tr>
							<th scope="col" colspan="9">管理员列表</th>
						</tr>
						<tr class="text-c">
							<th width="25"><input type="checkbox" name="" value=""></th>
							<th width="40">ID</th>
							<th width="150">姓名</th>
							<th width="90">手机</th>
							<th width="150">账号</th>
							<th>角色</th>
							<th width="130">加入时间</th>
							<th width="100">是否已启用</th>
							<th width="100">操作</th>
						</tr>
					</thead>
					<tbody>
					@foreach ($adminRes as $admin)
						<tr class="text-c">
							<td><input type="checkbox" value="{{$admin->id}}" name="del"></td>
							<td>{{$admin->id}}</td>
							<td>{{$admin->real_name}}</td>
							<td>{{$admin->tel}}</td>
							<td>{{$admin->account}}</td>
							<td>{{$admin->adminRole->name}}</td>
							<td>{{$admin->created_at}}</td>
							<td class="td-status">@if($admin->state == 1)<span class="label label-success radius">已启用</span>@else <span class="label label-default radius">已禁用</span> @endif</td>
							<td class="td-manage">
								<a style="text-decoration:none" onClick="@if($admin->state == 1) admin_stop(this,{{$admin->id}}) @else admin_start(this,{{$admin->id}}) @endif" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>
								<a title="编辑" href="javascript:;" onclick="admin_edit('管理员编辑','{{url("admin/adn/$admin->id/edit")}}','800','500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
								<a title="删除" href="javascript:;" onclick="admin_del({{$admin->id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				<div class="text-r">
					{{$adminRes->links()}}
				</div>
			</div>
		</article>
	</div>
</section>
@stop

@section('script')
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
/*管理员-增加*/
function admin_add(title,url,w,h){
	layer_show(title,url,w,h);
}

/*管理员-编辑*/
function admin_edit(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-停用*/
function admin_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
        update_state(id,{{\App\Model\Admin::ADMIN_STATE_OFF}});
		//此处请求后台程序，下方是成功后的前台处理……
		$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,id)" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
		$(obj).remove();
		layer.msg('已停用!',{icon: 5,time:1000});
	});
}

/*管理员-启用*/
function admin_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
        update_state(id,{{\App\Model\Admin::ADMIN_STATE_ON}});
		$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,id)" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
		$(obj).remove();
		layer.msg('已启用!', {icon: 6,time:1000});
	});
}

/*资讯-修改状态*/
function update_state(id,state){
    $.ajax({
        type: 'POST',
        url: '{{url("admin/adn/edit_state")}}',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{id:id,state:state},
        dataType: 'json',
        success: function(data){
            if(data.code == 100){
                return true;
            }else{
                return false;
            }
        }
    });
}

function datadel(){
    var app_value = [];
    $("input:checkbox[name=del]:checked").each(function(i){
        app_value.push($(this).val());
    });
    admin_del(app_value);
}

/*资讯-删除*/
function admin_del(id){
    layer.confirm('确认要删除吗？',function(index){
        $.ajax({
            type: 'POST',
            url: '{{url("admin/adn/del")}}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{id:id,_method:"delete"},
            dataType: 'json',
            success: function(data){
                if(data.code == 100){
                    window.location.href="{{url("admin/adn")}}";
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