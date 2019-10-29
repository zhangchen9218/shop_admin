@extends('admin.layouts.base')
@section('content')
<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 模板管理 <span class="c-gray en">&gt;</span> 模板列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<form action="{{url("admin/template")}}" method="get">
				<div class="text-c">
					<input type="text" name="keyword" id="" placeholder="模板名称" style="width:250px" class="input-text">
					<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜模板</button>
				</div>
			</form>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l">
					@if(Assist::checkRoutePower("admin/template/{template}","delete"))
					<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
					@endif

					@if(Assist::checkRoutePower("admin/template/create"))
					<a class="btn btn-primary radius" onclick="template_add('添加模板','{{url("admin/template/create")}}')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加模板</a>
					@endif
				</span>
				<span class="r">共有数据：<strong>54</strong> 条</span>
			</div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<th width="40"><input name="" type="checkbox" value=""></th>
							<th width="80">ID</th>
							<th width="100">分类</th>
							<th width="100">封面</th>
							<th>模板名称</th>
							<th width="60">状态</th>
							<th width="100">操作</th>
						</tr>
					</thead>
					<tbody>
					@foreach ($templates as $template)
						<tr class="text-c">
							<td><input name="del" type="checkbox" value="{{$template->id}}"></td>
							<td>{{$template->id}}</td>
							<td>@foreach(COLUMN_CATEGORY as $v)@if($v['id']==$template->type){{$v['name']}}@endif @endforeach</td>
							<td><img width="100" class="template-thumb" src="{{$template->icon}}"></td>
							<td class="text-l"><a class="maincolor" href="javascript:;" onClick="template_show('模板demo','{{url("admin/template/$template->id")}}')">{{$template->name}}</a></td>
							<td class="td-status">
								@if(Assist::checkRoutePower("admin/template/edit_state","post"))
									@if ($template->state == TEMPLATE_START)
										<button onclick="template_state_update( {{$template->id}},{{TEMPLATE_STOP}})" class="btn btn-success radius 	size-MINI">已开启</button>
									@else
										<button class="btn btn-default radius size-MINI" onclick="template_state_update( {{$template->id}},{{TEMPLATE_START}})">已关闭</button>
									@endif
								@else
									@if ($template->state == TEMPLATE_START)
										<span class="label label-success radius">已开启</span>
									@else
										<span class="label label-defaunt radius">已关闭</span>
									@endif
								@endif
							</td>
							<td class="td-manage">
								@if(Assist::checkRoutePower("admin/template/{template}/edit"))
									<a style="text-decoration:none" class="ml-5" onClick="template_edit('模板编辑','{{url("admin/template/$template->id/edit")}}')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
								@endif
								@if(Assist::checkRoutePower("admin/template/{template}","delete"))
									<a style="text-decoration:none" class="ml-5" onClick="template_del({{$template->id}})" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
								@endif
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				<div class="text-r">
					{{$templates->links()}}
				</div>
			</div>
		</article>
	</div>
</section>
@stop

@section('script')
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/lib/My97DatePicker/4.8/WdatePicker.js"></script>
{{--<script type="text/javascript" src="lib/datatables/1.10.0/jquery.dataTables.min.js"></script>--}}
<script type="text/javascript" src="/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">

@if(Assist::checkRoutePower("admin/template/create"))
/*模板-添加*/
function template_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
@endif

/*模板-查看*/
function template_show(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}

@if(Assist::checkRoutePower("admin/template/{template}/edit"))
/*模板-编辑*/
function template_edit(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
@endif

@if(Assist::checkRoutePower("admin/template/{template}","delete"))
function datadel(){
    var app_value = [];
    $("input:checkbox[name=del]:checked").each(function(i){
        app_value.push($(this).val());
    });
    template_del(app_value);
}
/*模板-删除*/
function template_del(id){
    layer.confirm('确认删除吗？',function(index){
        $.ajax({
            type: 'POST',
            url:"{{url("admin/template/del")}}",
            data:{id:id,_method:"delete"},
            dataType:"json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                if(data.code == 100){
                    window.location.href="{{url("admin/template")}}";
                }else{
                    layer.msg(data.msg,{icon:5,time:1000});
                }
            }
        });
    });
}
@endif

@if(Assist::checkRoutePower("admin/template/edit_state","post"))
function template_state_update(id,state){
    $.ajax({
        type: 'POST',
        url:"{{url("admin/template/edit_state")}}",
        data:{id:id,state:state},
        dataType:"json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){
            if(data.code == 100){
                window.location.href="{{url("admin/template")}}";
            }else{
                layer.msg(data.msg,{icon:5,time:1000});
            }
        }
    });
}
@endif
</script>
<!--/请在上方写此页面业务相关的脚本-->
@stop