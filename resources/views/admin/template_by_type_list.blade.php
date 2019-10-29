@include('admin.layouts._meta')
<article class="page-container">
	<div class="pd-10">
		<div class="portfolio-content">
			<ul class="cl portfolio-area">
				<li class="item">
					<label>
						<div class="portfoliobox">
							<div class="picbox">
								<img src="">
							</div>
							<div id="temp_name_0" class="mt-5 text-c">
								<input type="radio" name="template_id"  value="0">
								默认模板
							</div>
						</div>
					</label>
				</li>
				@foreach($templateRes as $template)
				<li class="item">
					<label>
						<div class="portfoliobox">
							<div class="picbox">
								<img src="{{$template->icon}}">
							</div>
							<div id="temp_name_{{$template->id}}" class="mt-5 text-c">
								<input type="radio" name="template_id"  value="{{$template->id}}">
								{{$template->name}}
							</div>
						</div>
					</label>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
	<div class="text-c mt-15"><button class="btn btn-primary radius" onclick="affirm()">确定</button></div>
</article>

<!--_footer 作为公共模版分离出去-->
@include("admin.layouts._footer")
<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script>
	function affirm(){
	    var id = $("input:radio:checked").val();
	    var name = $("#temp_name_"+id).text();
        parent.$('#template_name').text(name);
        parent.$('#template_id').val(id);
        var index = parent.layer.getFrameIndex(window.name);
        parent.layer.close(index);
	}
</script>
<!--/请在上方写此页面业务相关的脚本-->