<!--_meta 作为公共模版分离出去-->
@include('admin.layouts._meta')
<!--/meta 作为公共模版分离出去-->

<title>@yield("title","shop系统")</title>
<meta name="keywords" content="@yield("keywords","")">
<meta name="description" content="@yield("description","")">
</head>
<body>
<!--_header 作为公共模版分离出去-->
@include('admin.layouts._header')
<!--/_header 作为公共模版分离出去-->

<!--_menu 作为公共模版分离出去-->
@include('admin.layouts._menu')
<!--/_menu 作为公共模版分离出去-->

@section("content")
	<section class="Hui-article-box">
		<nav class="breadcrumb">
			@section('nav')
			@show
		</nav>
		<div class="Hui-article">
			<article class="cl pd-20">
					<h3 class="text-c">欢迎你登录到自由学后台系统</h3>
			</article>
		</div>
	</section>
@show
<!--_footer 作为公共模版分离出去-->
@include('admin.layouts._footer')
<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
@section('script')

@show
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>