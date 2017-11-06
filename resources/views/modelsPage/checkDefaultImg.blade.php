<link href="{{ asset('/layui/css/layui.css') }}" rel='stylesheet' media="all" type='text/css'>

<style type="text/css">
	body{
		background-color: #fff;
	}

	.row{
		width: 100%;
	}

	.content{
		width: 100%;
		height: 280px;
		padding: 10px;
		box-sizing: border-box;
	    -moz-box-sizing:border-box; /* Firefox */
	    -webkit-box-sizing:border-box; /* Safari */
	}

	.img-item{
		width: 100px;
		height: 130px;
		border: 1px solid #ccc;
		float: left;
		margin-left: 20px;
		text-align: center;
		margin-bottom: 10px;
		cursor: pointer;
	}

	.img-item img{
		width: 95px;
		height: 95px;
		margin-top: 5px;
	}

	.img-item span{
		line-height: 30px;
		font-size: 14px;
		color: #9a9898;
	}

	.selected{
		box-shadow: inset 0px 0px 5px 0px #05f591;
	}

	.layui-laypage{
		float: right;
    	margin-right: 30px
	}
</style>

<div class="row">
	
	<div class="content">
		
		@foreach($imagelist->list as $image)
			<div class="img-item">
				<img src="{{ $image->url }}-live">
				<span>{{ $image->title }}</span>
			</div>
		@endforeach

	</div>

	<fieldset class="layui-elem-field layui-field-title" id="demo1" style="margin-top: 20px;">
	  <legend>开门见山 ： 默认分页</legend>
	</fieldset>

</div>

<script type="text/javascript" src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('/layui/layui.js') }}"></script>

<script type="text/javascript">

	var index = parent.layer.getFrameIndex(window.name);

	$(".img-item").click(function(){
		$(".img-item").removeClass("selected");
		$(this).addClass("selected");
		var url = $(this).children("img").attr("src");
		parent.$("#xmTanImg").attr("src",url);
		console.log(url);
	})

	layui.use(['laypage', 'layer'], function(){
	  	var laypage = layui.laypage
	  	,layer = layui.layer;

	  	laypage({
		    cont: 'demo1'
		    ,groups: 5 //连续显示分页数
		  	,pages: {{ $imagelist->page }} //总页数
		    ,count: {{ $imagelist->count }}
		    ,limit : 10
		    ,curr : 1
		    ,layout: ['prev', 'next']
		    ,jump : function(obj, first){
		    	if (!first) {
		    		$.ajax({
				  		url : "{{ URL::to('imageManage/getImageListByCatIDLimit') }}",
				        type : "POST",
				        dataTpye : "json",
				        data : {
				        	limit : obj.limit,
				        	offset : obj.curr,
				        	catid : 1
				        },
				        success:function(data){
				        	var res = eval('(' + data + ')');
				        	var a = '';
				        	for (var i = res.list.length - 1; i >= 0; i--) {
				        		a += '<div class="img-item">'
								a += '	<img src="'+res.list[i].url+'-live">'
								a += '	<span>'+res.list[i].title+'</span>'
								a += '</div>'
				        	}
				        	$(".content").html(a);
				        }
				  	})
		    	}
		    }
	  	});
	  

	  
	});
	

</script>
