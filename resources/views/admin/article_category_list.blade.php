@extends('admin.layouts.base')
@section('content')
<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span class="c-gray en">&gt;</span> 栏目管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="pd-20 text-c">
		<div class="text-c">
			<form action="{{url("admin/art_category ")}}">
				<input type="text" name="keyword" id="keyword" placeholder="分类名称、id" style="width:250px" value="{{$keyword}}" class="input-text">
				<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
			</form>
		</div>
		<div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                @if(Assist::checkRoutePower("admin/art_category/{art_category}","delete"))
                <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
                @endif

                @if(Assist::checkRoutePower("admin/art_category/create"))
                <a class="btn btn-primary radius" onclick="article_category_add('添加资讯分类','{{url("admin/art_category/create")}}',400,300)" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加栏目</a>
                @endif
            </span>
        </div>
		<div class="mt-20">
			<table class="table table-border table-bordered table-hover table-bg table-sort">
				<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="80">ID</th>
					<th>分类名称</th>
					<th>状态</th>
					<th width="100">操作</th>
				</tr>
				</thead>
				<tbody>
                @foreach ($categories as $category)
                    <tr class="text-c">
                        <td><input type="checkbox" name="del" value="{{$category->id}}"></td>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>
                            @if(Assist::checkRoutePower("admin/art_category/edit_state","post"))
                                @if ($category->state == ARTICLE_CATEGORY_START)
                                    <button onclick="article_category_update( {{$category->id}},{{ARTICLE_CATEGORY_STOP}})" class="btn btn-success radius 	size-MINI">已开启</button>
                                @else
                                    <button class="btn btn-default radius size-MINI" onclick="article_category_update( {{$category->id}},{{ARTICLE_CATEGORY_START}})">已关闭</button>
                                @endif
                            @else
                                @if ($category->state == ARTICLE_CATEGORY_START)
                                    <span class="label label-success radius">已开启</span>
                                @else
                                    <span class="label label-defaunt radius">已关闭</span>
                                @endif
                            @endif
                        </td>
                        <td class="f-14">
                            @if(Assist::checkRoutePower("admin/art_category/{art_category}/edit"))
                            <a title="编辑" href="javascript:;" onclick="article_category_edit('资讯分类编辑','{{url("admin/art_category/$category->id/edit")}}',400,300)" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                            @endif

                            @if(Assist::checkRoutePower("admin/art_category/{art_category}","delete"))
                            <a title="删除" href="javascript:;" onclick="article_category_del({{$category->id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
				</tbody>
			</table>
		</div>
	</div>

</section>
@stop

@section('script')
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/lib/My97DatePicker/4.8/WdatePicker.js"></script>
{{--<script type="text/javascript" src="/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>--}}
{{--<script type="text/javascript" src="/lib/laypage/1.2/laypage.js"></script>--}}
<script type="text/javascript">

@if(Assist::checkRoutePower("admin/art_category/create"))
/*系统-栏目-添加*/
function article_category_add(title,url,w,h){
	layer_show(title,url,w,h);
}
@endif

@if(Assist::checkRoutePower("admin/art_category/{art_category}/edit"))
/*系统-栏目-编辑*/
function article_category_edit(title,url,w,h){
	layer_show(title,url,w,h);
}
@endif

@if(Assist::checkRoutePower("admin/art_category/{art_category}","delete"))
function datadel(){
    var app_value = [];
    $("input:checkbox[name=del]:checked").each(function(i){
        app_value.push($(this).val());
    });
    article_category_del(app_value);
}
/*系统-栏目-删除*/
function article_category_del(id){
    layer.confirm('确认删除吗？',function(index){
        $.ajax({
            type: 'POST',
            url:"{{url("admin/art_category/del")}}",
            data:{id:id,_method:"delete"},
            dataType:"json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                if(data.code == 100){
                    window.location.href="{{url("admin/art_category")}}";
                }else{
                    layer.msg(data.msg,{icon:5,time:1000});
                }
            }
        });
    });
}
@endif

@if(Assist::checkRoutePower("admin/art_category/edit_state","post"))
function article_category_update(id,state){
    $.ajax({
        type: 'POST',
        url:"{{url("admin/art_category/edit_state")}}",
        data:{id:id,state:state},
        dataType:"json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){
            if(data.code == 100){
				window.location.href="{{url("admin/art_category")}}";
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