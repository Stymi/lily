@extends('app')


@section('plugins')
<link href="{{ asset('/layui/css/layui.css') }}" rel='stylesheet' media="all" type='text/css'>

<style type="text/css">
	
.layui-form-item .layui-input-inline{
	margin-left: 15px;
}
.layui-input-block{
	margin-left: 135px;
}
.layui-form-label{
	width: 120px;
	text-align: center;
}
.techerimg{
	width: 500px;
	height: 200px;
	border: 1px solid #aaa;
	/*border-radius: 40px;*/
	float: left;
}
.techerimg img{
	width: 498px;
	height: 198px;
	overflow: hidden;
}
.layui-upload-button{
	margin-left: 20px;
}
</style>
@endsection

@section('content')
<div>
	<div class="page-title">
		<div class="title_left">
			<h3>图片上传</h3>
		</div>

	</div>
</div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

			<div class="x_content">
				<form class="layui-form" action="" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="layui-form-item">
						<label class="layui-form-label">标题</label>
						<div class="layui-input-block">
							<input type="text" name="imgtitle" required  lay-verify="required" placeholder="请输入图片标题" autocomplete="off" class="layui-input"></div>
					</div>

					<div class="layui-form-item">
						<label class="layui-form-label">图片分类</label>
						<div class="layui-input-block">
							@foreach($categorylist as $category)
							<input type="radio" name="imgcategory" value="{{ $category->
							id }}" title="{{ $category->c_name }}">
							@endforeach
						</div>
					</div>

					<div class="layui-form-item">
						<label class="layui-form-label">是否禁用</label>
						<div class="layui-input-block">
							<input type="radio" name="type" value="0" title="禁用">
							<input type="radio" name="type" value="1" title="启用" checked></div>
					</div>

					<div class="layui-form-item" style="line-height: 80px;">
						<label class="layui-form-label" style="margin-top: 22px;">图像</label>
						<div class="layui-input-block">
							<div class="techerimg" id="xmTanDiv">
								<img id="xmTanImg"/>
							</div>
							<div class="layui-box layui-upload-button">
								<input type="file" name="file" class="layui-upload-file" id="xdaTanFileImg" onchange="xmTanUploadImg(this)">
								<span class="layui-upload-icon"> <i class="layui-icon">&#xe61f;</i>
									上传图片
								</span>
							</div>
						</div>
					</div>

					<div class="layui-form-item layui-form-text">
						<label class="layui-form-label">图片简介</label>
						<div class="layui-input-block">
							<textarea name="msg" placeholder="请输入内容" class="layui-textarea"></textarea>
						</div>
					</div>

					<div class="layui-form-item">
						<div class="layui-input-block">
							<button class="layui-btn" lay-submit lay-filter="formSubimt">立即提交</button>
							<button type="reset" class="layui-btn layui-btn-primary">重置</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('Jsplugins')
<script type="text/javascript" src="{{ asset('/layui/layui.js') }}"></script>

<script type="text/javascript">


	
	layui.use(['form','upload'], function(){
		if (typeof FileReader == 'undefined') {
			layer.msg("当前浏览器不支持FileReader接口",{
				icon:2
			})
	        document.getElementById("xmTanDiv").InnerHTML = "<h1>当前浏览器不支持FileReader接口</h1>";
	        //使选择控件不可操作
	        document.getElementById("xdaTanFileImg").setAttribute("disabled", "disabled");
	    }

  		var form = layui.form();
  		
  		form.on('submit(formSubimt)', function(data){
  			var load = layer.load(2);
  			var formData = new FormData($('form')[0]); 
  			formData.append('file',$(':file')[0].files[0]);
    		$.ajax({
		  		url : "{{ URL::to('imageManage/createImageFile') }}",
		        type : "POST",
		        dataTpye : "json",
		        data : formData,
		        contentType: false,
		        processData: false,
		        success:function(res){

		        	var obj = eval('(' + res + ')');

		        	layer.close(load);

		        	if (obj.statusCode == 1) {
		        		layer.confirm('添加成功', {
						  btn: ['前往列表页','留在本页'] //按钮
						}, function(){
						  	window.location.href = "{{ URL::to('imageManage/indexPage') }}";
						}, function(){
						  	window.location.href = "";
						});
		        	}else{
		        		layer.msg(obj.statusMsg,{icon : 2});
		        	}
		        },
		        error:function(err){
	                layer.msg("提交失败", {icon: 0});
	            }
		  	})
    		return false;
  		});
	});

	//选择图片，马上预览
    function xmTanUploadImg(obj) {
        var file = obj.files[0];
        console.log(file);
        console.log("file.type = " + file.type);  //file.size 单位为byte

        if (file.type !== "image/jpeg"  && file.type !== "image/jpg" && file.type !== "image/png" && file.type !== "image/gif") {
        	layer.msg("请上传图片",{
        		icon : 0
        	})
        	return false;
        }

        var reader = new FileReader();

        //读取文件过程方法
        reader.onloadstart = function (e) {
            console.log("开始读取....");
        }
        reader.onprogress = function (e) {
            console.log("正在读取中....");
        }
        reader.onabort = function (e) {
        	layer.msg("中断读取....",{
				icon:2
			})
            console.log("中断读取....");
        }
        reader.onerror = function (e) {
        	layer.msg("读取异常....",{
				icon:0
			})
            console.log("读取异常....");
        }
        reader.onload = function (e) {
            console.log("成功读取....");

            var img = document.getElementById("xmTanImg");
            img.src = e.target.result;
            //或者 img.src = this.result;  //e.target == this
        }

        reader.readAsDataURL(file)
    }

</script>
@endsection