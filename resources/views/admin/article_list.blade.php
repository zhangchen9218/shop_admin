@extends('admin.layouts.base')
@section('content')
<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
		<span class="c-gray en">&gt;</span>
		资讯管理
		<span class="c-gray en">&gt;</span>
		资讯列表
		<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
	</nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<div class="text-c">
				<form action="{{url('admin/article')}}" method="get">
					<span class="select-box inline">
						<select name="category" class="select">
							<option value="0">全部分类</option>
							@foreach ($categorys as $key=>$category)
								<option value="{{$category->id}}" @if ($search['category'] && $search['category'] == $category->id) selected @endif>{{$category->name}}</option>
							@endforeach
						</select>
					</span>
					<span class="select-box inline">
						<select name="state" class="select">
							<option value="0">全部状态</option>
							@foreach (ARTICLE_STATE as $key=>$state)
								<option value="{{$key}}" @if ($search['state'] && $search['state'] == $key) selected @endif>{{$state}}</option>
							@endforeach
						</select>
					</span>
					日期范围：
					<input type="text" name="start_at" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}'})" @if($search['startAt']) value="{{$search['startAt']}}" @endif id="logmin" class="input-text Wdate" style="width:120px;">
					-
					<input type="text" name="end_at" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d'})" @if($search['endAt']) value="{{$search['endAt']}}" @endif id="logmax" class="input-text Wdate" style="width:120px;">
					<input type="text" name="title" id="" placeholder=" 资讯名称" style="width:250px" class="input-text" @if($search['title']) value="{{$search['title']}}" @endif>
					<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜资讯</button>
				</form>
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l">
				@if(Assist::checkRoutePower("admin/article/{article}","delete"))
				<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
				@endif
				@if(Assist::checkRoutePower("admin/article/create"))
				<a class="btn btn-primary radius" data-title="添加资讯" _href="{{url("admin/article/create")}}" onclick="article_add('添加资讯','{{url("admin/article/create")}}')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加资讯</a>
				@endif
				</span>
				<span class="r">共有数据：<strong>{{$articles->total()}}</strong> 条</span>
			</div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<th width="25"><input type="checkbox" name="" value=""></th>
							<th width="80">ID</th>
							<th>标题</th>
							<th width="80">分类</th>
							<th width="80">来源</th>
							<th width="120">操作者</th>
							<th width="120">审核者</th>
							<th width="120">更新时间</th>
							<th width="75">浏览次数</th>
							<th width="60">发布状态</th>
							<th width="120">操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($articles as $article)
						<tr class="text-c">
							<td><input type="checkbox" value="{{$article->id}}" name="del"></td>
							<td>{{$article->id}}</td>
							<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="article_show('查看','{{url("admin/article/$article->id")}}','{{$article->id}}')" title="查看">{{$article->title}}</u></td>
							<td>@if($article->category) {{$article->category->name}} @endif</td>
							<td>{{$article->source}}</td>
							<td>{{$article->operator->real_name}}</td>
							<td>{{$article->verifier ? $article->verifier->real_name : ""}}</td>
							<td>{{$article->updated_at}}</td>
							<td>{{$article->impression}}</td>
							<td class="td-status">
								@if ($article->state == ARTICLE_STATE_DRAFT)
									<span class="label label-success radius">{{ARTICLE_STATE_DRAFT_STR}}</span>
								@elseif ($article->state == ARTICLE_STATE_AUDIT)
									<span class="label label-default radius">{{ARTICLE_STATE_AUDIT_STR}}</span>
								@elseif ($article->state == ARTICLE_STATE_PUBLISH)
									<span class="label label-success radius">{{ARTICLE_STATE_PUBLISH_STR}}</span>
								@elseif ($article->state == ARTICLE_STATE_UNSHELVE)
									<span class="label label-defaunt radius">{{ARTICLE_STATE_UNSHELVE_STR}}</span>
								@elseif ($article->state == ARTICLE_STATE_FAIL)
									<span class="label label-danger radius">{{ARTICLE_STATE_FAIL_STR}}</span>
								@endif
							</td>
							<td class="f-14 td-manage">
								@if(Assist::checkRoutePower("admin/article/edit_state","post"))

									@if ($article->state == ARTICLE_STATE_DRAFT ||$article->state == ARTICLE_STATE_FAIL )

										<a style="text-decoration:none" onClick="article_shenqing(this,{{$article->id}},{{ARTICLE_STATE_AUDIT}})" href="javascript:;" title="申请上线">申请上线</a>

									@elseif ($article->state == ARTICLE_STATE_AUDIT || $article->state == ARTICLE_STATE_UNSHELVE)

										<a style="text-decoration:none" onClick="article_shenhe(this,{{$article->id}})" href="javascript:;" title="审核">审核</a>

									@elseif ($article->state == ARTICLE_STATE_PUBLISH)

										<a style="text-decoration:none" onClick="article_stop(this,{{$article->id}},{{ARTICLE_STATE_UNSHELVE}})" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>

									@endif

								@endif

								@if(Assist::checkRoutePower("admin/article/{article}/edit"))
								<a style="text-decoration:none" class="ml-5" onClick="article_edit('资讯编辑','{{url("admin/article/$article->id/edit")}}')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
								@endif

								@if(Assist::checkRoutePower("admin/article/{article}","delete"))
								<a style="text-decoration:none" class="ml-5" onClick="article_del({{$article->id}})" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
								@endif
						</tr>
						@endforeach
					</tbody>
				</table>
				<div class="text-r">
					{{$articles->links()}}
				</div>
			</div>
		</article>
	</div>
</section>
@stop

@section('script')
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/lib/My97DatePicker/4.8/WdatePicker.js"></script>
{{--<script type="text/javascript" src="/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>--}}


<script type="text/javascript">

@if(Assist::checkRoutePower("admin/article/create"))
/*资讯-添加*/
function article_add(title,url,w,h){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
@endif

/*资讯-详情*/
function article_show(title,url,id,w,h){
    var index = layer.open({
        type: 2,
        title: title,
        content: url
    });
    layer.full(index);
}

@if(Assist::checkRoutePower("admin/article/{article}/edit"))
/*资讯-编辑*/
function article_edit(title,url,id,w,h){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
@endif

@if(Assist::checkRoutePower("admin/article/{article}","delete"))
function datadel(){
    var app_value = [];
    $("input:checkbox[name=del]:checked").each(function(i){
        app_value.push($(this).val());
    });
    article_del(app_value);
}

/*资讯-删除*/
function article_del(id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '{{url("admin/article/del")}}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{id:id,_method:"delete"},
			dataType: 'json',
			success: function(data){
				if(data.code == 100){
                    window.location.href="{{url("admin/article")}}";
				}else{
                    layer.msg(data.msg,{icon:5,time:1000});
				}
			}
		});		
	});
}
@endif

@if(Assist::checkRoutePower("admin/article/edit_state","post"))
/*资讯-审核*/
function article_shenhe(obj,id){
	layer.confirm('审核文章？', {
		btn: ['通过','不通过','取消'], 
		shade: false,
		closeBtn: 0
	},
	function(){
        update_state(id,{{ARTICLE_STATE_PUBLISH}});
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,id,{{ARTICLE_STATE_UNSHELVE}})" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">{{ARTICLE_STATE_PUBLISH_STR}}</span>');
		$(obj).remove();
		layer.msg('{{ARTICLE_STATE_PUBLISH_STR}}', {icon:6,time:1000});
	},
	function(){
        update_state(id,{{ARTICLE_STATE_FAIL}});
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_shenqing(this,id,{{ARTICLE_STATE_DRAFT}})" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">{{ARTICLE_STATE_FAIL_STR}}</span>');
		$(obj).remove();
    	layer.msg('{{ARTICLE_STATE_FAIL_STR}}', {icon:5,time:1000});
	});	
}
/*资讯-下架*/
function article_stop(obj,id,state){
	layer.confirm('确认要下架吗？',function(index){
        update_state(id,state);
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_shenhe(this,id)" href="javascript:;" title="审核">审核</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">{{ARTICLE_STATE_UNSHELVE_STR}}</span>');
		$(obj).remove();
		layer.msg('{{ARTICLE_STATE_UNSHELVE_STR}}!',{icon: 5,time:1000});
	});
}

/*资讯-发布*/
function article_start(obj,id,state){
	layer.confirm('确认要发布吗？',function(index){
        update_state(id,state);
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,id,ARTICLE_STATE_UNSHELVE)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">{{ARTICLE_STATE_PUBLISH_STR}}</span>');
		$(obj).remove();
		layer.msg('{{ARTICLE_STATE_PUBLISH_STR}}!',{icon: 6,time:1000});
	});
}
/*资讯-申请上线*/
function article_shenqing(obj,id,state){
    update_state(id,state);
	$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">{{ARTICLE_STATE_AUDIT_STR}}</span>');
	$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_shenhe(this,id)" href="javascript:;" title="审核">审核</a>');
    $(obj).remove();
	layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
}
/*资讯-修改状态*/
function update_state(id,state){
	$.ajax({
		type: 'POST',
		url: '{{url("/admin/article/edit_state")}}',
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

@endif
</script>
<!--/请在上方写此页面业务相关的脚本-->
@stop