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
	width: 80px;
	height: 80px;
	border: 1px solid #aaa;
	border-radius: 40px;
	float: left;
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
			<h3>添加图片分类</h3>
		</div>

	</div>
</div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

			<div class="x_content">
				<form class="layui-form" action="">
					{{ csrf_field() }}
					<div class="layui-form-item">
						<label class="layui-form-label">分类标题</label>
						<div class="layui-input-block">
							<input type="text" name="c_name" required  lay-verify="required" placeholder="请输入分类标题" autocomplete="off" class="layui-input"></div>
					</div>
					
					<div class="layui-form-item">
						<label class="layui-form-label">是否启用</label>
						<div class="layui-input-block">
							<input type="radio" name="c_status" value="0" title="禁用">
							<input type="radio" name="c_status" value="1" title="启用" checked></div>
					</div>
					
					<div class="layui-form-item layui-form-text">
						<label class="layui-form-label">分类描述</label>
						<div class="layui-input-block">
							<textarea name="c_desc" placeholder="请输入内容" class="layui-textarea"></textarea>
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
	
	layui.use(['form'], function(){
  		var form = layui.form();
  	
  		form.on('submit(formSubimt)', function(data){
  			var load = layer.load(2);
    		$.ajax({
		  		url : "{{ URL::to('imageManage/createImageCategory') }}",
		        type : "POST",
		        dataTpye : "json",
		        data : data.field,
		        success:function(res){

		        	var obj = eval('(' + res + ')');

		        	if (obj.statusCode == 1) {
		        		layer.confirm('添加成功', {
						  btn: ['前往列表页','留在本页'] //按钮
						}, function(){
						  	window.location.href = "{{ URL::to('') }}";
						}, function(){
						  	window.location.href = "{{ URL::to('imageManage/imageCategory') }}";
						});
		        	}else{
		        		layer.msg("未知原因失败",{icon : 2});
		        	}
		        },
		        error:function(err){
	                layer.msg("提交失败", {icon: 0});
	            }
		  	})
		  	layer.close(load);
    		return false;
  		});
	});

</script>
@endsection