<aside class="Hui-aside">
	<div class="menu_dropdown bk_2">
		@if(Assist::checkRoutePower("article","",true))
		<dl id="menu-article">
			<dt><i class="Hui-iconfont">&#xe616;</i> 资讯管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					@if(Assist::checkRoutePower("admin/art_category"))
					<li @if(Request::getRequestUri() == "/admin/art_category")class="current"@endif><a href="{{url("admin/art_category")}}" title="资讯分类">资讯分类</a></li>
					@endif
					@if(Assist::checkRoutePower("admin/article"))
					<li @if(Request::getRequestUri() == "/admin/article")class="current"@endif><a href="{{url("admin/article")}}" title="资讯管理">资讯管理</a></li>
					@endif
				</ul>
			</dd>
		</dl>
		@endif
		@if(Assist::checkRoutePower("template","",true))
		<dl id="menu-article">
			<dt><i class="Hui-iconfont">&#xe72d;</i> 模板管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					@if(Assist::checkRoutePower("admin/template"))
					<li @if(Request::getRequestUri() == "/admin/template")class="current"@endif><a href="{{url("admin/template")}}" title="模板管理">模板管理</a></li>
					@endif
				</ul>
			</dd>
		</dl>
		@endif
		{{--<dl id="menu-picture">--}}
			{{--<dt><i class="Hui-iconfont">&#xe613;</i> 图片管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>--}}
			{{--<dd>--}}
				{{--<ul>--}}
					{{--<li><a href="picture-list.html" title="图片管理">图片管理</a></li>--}}
				{{--</ul>--}}
			{{--</dd>--}}
		{{--</dl>--}}
		{{--<dl id="menu-product">--}}
			{{--<dt><i class="Hui-iconfont">&#xe620;</i> 产品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>--}}
			{{--<dd>--}}
				{{--<ul>--}}
					{{--<li><a href="product-brand.html" title="品牌管理">品牌管理</a></li>--}}
					{{--<li><a href="product-category.html" title="分类管理">分类管理</a></li>--}}
					{{--<li><a href="product-list.html" title="产品管理">产品管理</a></li>--}}
				{{--</ul>--}}
			{{--</dd>--}}
		{{--</dl>--}}
		{{--<dl id="menu-comments">--}}
			{{--<dt><i class="Hui-iconfont">&#xe622;</i> 评论管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>--}}
			{{--<dd>--}}
				{{--<ul>--}}
					{{--<li><a href="http://h-ui.duoshuo.com/admin/" title="评论列表">评论列表</a></li>--}}
					{{--<li><a href="feedback-list.html" title="意见反馈">意见反馈</a></li>--}}
				{{--</ul>--}}
			{{--</dd>--}}
		{{--</dl>--}}
		@if(Assist::checkRoutePower("admin","",true))
		<dl id="menu-member">
			<dt><i class="Hui-iconfont">&#xe60d;</i> 会员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					@if(Assist::checkRoutePower("admin/user"))
					<li @if(Request::getRequestUri() == "/admin/user")class="current"@endif><a href="{{url("admin/user")}}" title="会员列表">会员列表</a></li>
					@endif
					{{--<li><a href="member-del.html" title="删除的会员">删除的会员</a></li>--}}
					{{--<li><a href="member-level.html" title="等级管理">等级管理</a></li>--}}
					{{--<li><a href="member-scoreoperation.html" title="积分管理">积分管理</a></li>--}}
					{{--<li><a href="member-record-browse.html" title="浏览记录">浏览记录</a></li>--}}
					{{--<li><a href="member-record-download.html" title="下载记录">下载记录</a></li>--}}
					{{--<li><a href="member-record-share.html" title="分享记录">分享记录</a></li>--}}
				</ul>
			</dd>
		</dl>
		@endif
		@if(Assist::checkRoutePower("admin","",true))
		<dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					@if(Assist::checkRoutePower("admin/role"))
					<li @if(Request::getRequestUri() == "/admin/role")class="current"@endif><a href="{{url("admin/role")}}" title="角色管理">角色管理</a></li>
					@endif
					@if(Assist::checkRoutePower("admin/power"))
					<li @if(Request::getRequestUri() == "/admin/power")class="current"@endif><a href="{{url("admin/power")}}" title="权限管理">权限管理</a></li>
					@endif

					@if(Assist::checkRoutePower("admin/adn"))
					<li @if(Request::getRequestUri() == "/admin/adn")class="current"@endif><a href="{{url("admin/adn")}}" title="管理员列表">管理员列表</a></li>
					@endif
				</ul>
			</dd>
		</dl>
		@endif
		{{--<dl id="menu-tongji">--}}
			{{--<dt><i class="Hui-iconfont">&#xe61a;</i> 系统统计<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>--}}
			{{--<dd>--}}
				{{--<ul>--}}
					{{--<li><a href="charts-1.html" title="折线图">折线图</a></li>--}}
					{{--<li><a href="charts-2.html" title="时间轴折线图">时间轴折线图</a></li>--}}
					{{--<li><a href="charts-3.html" title="区域图">区域图</a></li>--}}
					{{--<li><a href="charts-4.html" title="柱状图">柱状图</a></li>--}}
					{{--<li><a href="charts-5.html" title="饼状图">饼状图</a></li>--}}
					{{--<li><a href="charts-6.html" title="3D柱状图">3D柱状图</a></li>--}}
					{{--<li><a href="charts-7.html" title="3D饼状图">3D饼状图</a></li>--}}
				{{--</ul>--}}
			{{--</dd>--}}
		{{--</dl>--}}
		@if(Assist::checkRoutePower("system","",true))
		<dl id="menu-system">
			<dt><i class="Hui-iconfont">&#xe62e;</i> 系统管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					{{--<li><a href="system-base.html" title="系统设置">系统设置</a></li>--}}
					@if(Assist::checkRoutePower("admin/column"))
					<li @if(Request::getRequestUri() == "/admin/column")class="current"@endif><a href="{{url("admin/column")}}" title="栏目管理">栏目管理</a></li>
					@endif
					{{--<li><a href="system-data.html" title="数据字典">数据字典</a></li>--}}
					{{--<li><a href="system-shielding.html" title="屏蔽词">屏蔽词</a></li>--}}
					{{--<li><a href="system-log.html" title="系统日志">系统日志</a></li>--}}
				</ul>
			</dd>
		</dl>
		@endif
	</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
