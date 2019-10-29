@extends('admin.layouts.base')
@section('content')
<section class="Hui-article-box">
	<div class="Hui-article">
		<article class="cl pd-20">
			<section class="page-404 minWP text-c">
			  <p class="error-title"><i class="Hui-iconfont va-m" style="font-size:80px">&#xe656;</i><span class="va-m"> error</span></p>
			  <p class="error-description">不好意思，您没有权限访问这个功能</p>
			  <p class="error-info">您可以：<a href="javascript:;" onclick="history.go(-1)" class="c-primary">&lt; 返回上一页</a><span class="ml-20">|</span><a href="{{url("admin")}}" class="c-primary ml-20">去首页 &gt;</a></p>
			</section>
		</article>
	</div>
</section>
@stop
