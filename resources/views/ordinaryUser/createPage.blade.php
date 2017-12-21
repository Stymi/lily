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
.techerimg img{
	width: 80px;
	height: 80px;
	border-radius: 40px;
	margin-top: -4px;
}
.layui-upload-button{
	margin-left: 20px;
	cursor: pointer;
}
</style>
@endsection

@section('content')
<div>
	<div class="page-title">
		<div class="title_left">
			<h3>添加用户账号</h3>
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
						<label class="layui-form-label">用户名</label>
						<div class="layui-input-block">
							<input type="text" name="nickname" placeholder="请输入用户名 , 可不填" autocomplete="off" class="layui-input"></div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">账号</label>
						<div class="layui-input-block">
							<input type="text" name="username" required  lay-verify="required" placeholder="请输入登陆账号" autocomplete="off" class="layui-input"></div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">密码框</label>
						<div class="layui-input-inline">
							<input type="password" name="password" placeholder="请输入密码" autocomplete="off" class="layui-input"></div>
						<div class="layui-form-mid layui-word-aux">不填写则默认密码与账号一致</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">用户权限</label>
						<div class="layui-input-block">
							<input type="checkbox" name="authority[live]" title="直播室" nameval="live" lay-filter="authority" id="checkedLive">
							<input type="checkbox" name="authority[wechat]" title="小程序" nameval="wechat" lay-filter="authority"></div>
					</div>
					<div class="layui-form-item" id="liveRoom" style="display: none;">
						<label class="layui-form-label">直播室</label>
						<div class="layui-input-block">
							@if($roomlist != null)
								@foreach($roomlist as $room)
							<input type="radio" name="room" title="{{ $room->name }}" value="{{ $room->id }}">
								@endforeach
							@endif
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">是否禁用</label>
						<div class="layui-input-block">
							<input type="radio" name="type" value="0" title="禁用">
							<input type="radio" name="type" value="1" title="启用" checked></div>
					</div>
					<div class="layui-form-item" style="line-height: 80px;">
						<label class="layui-form-label" style="margin-top: 22px;">用户头像</label>
						<div class="layui-input-block">
							<div class="techerimg">
								<img style="width: 100%;" src="{{ $img->url }}-live" id="xmTanImg"></div>
							<input type="hidden" name="headimg" id="headimg" value="{{ $img->
							url }}">
							<div class="layui-btn layui-btn-primary" style="height: 36px; line-height:36px;margin-left: 20px;" onclick="checkdefaultimg()"> <i class="layui-icon" style="color: #5FB878;margin-right: 5px;">&#xe64a;</i>
								选择默认头像
							</div>
						</div>
					</div>
					<div class="layui-form-item layui-form-text">
						<label class="layui-form-label">用户描述</label>
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

  		form.on('checkbox(authority)', function(data){
  			var nameval = data.elem.attributes.nameval.value;
  			if (nameval == "live") {
  				if (data.elem.checked === true) {
  					$("#liveRoom").css('display','block')
  				}else{
  					$("#liveRoom").css('display','none')
  				}
  			}
  	
		});  
  	
  		form.on('submit(formSubimt)', function(data){
  			
  			// var load = layer.load(2);
  			var radio = $('input:radio[name="room"]:checked').val();
  	
  			if($('#checkedLive').is(':checked')) {
			    if (radio == undefined || radio == null || radio == '') {
	  				layer.msg("请选择直播室",{
	  					icon : 0
	  				});
	  				return false;
	  			}
			}

    		$.ajax({
		  		url : "{{ URL::to('ordinaryUser/createOrdinaryUser') }}",
		        type : "POST",
		        dataTpye : "json",
		        data : data.field,
		        success:function(res){

		        	var obj = eval('(' + res + ')');

		        	// layer.close(load);

		        	if (obj.statusCode == 1) {
		        		layer.confirm('添加成功', {
						  btn: ['前往列表页','留在本页'] //按钮
						}, function(){
						  	window.location.href = "{{ URL::to('ordinaryUser/indexPage') }}";
						}, function(){
						  	window.location.href = "{{ URL::to('ordinaryUser/createPage') }}";
						});
		        	}else{
		        		layer.msg("未知原因失败",{icon : 2});
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
            $("#imgtype").val(2);
            //或者 img.src = this.result;  //e.target == this
        }

        reader.readAsDataURL(file)
    }

    function checkdefaultimg() {
    	layer.open({
		  	type: 2,
		  	area: ['650px', '450px'],
		  	title: "选择图片",
		  	fixed: false, //不固定
		  	maxmin: true,
		  	content: "{{ URL::to('expertManage/checkDefaultImg/1') }}"
		});
    }

   	

</script>
@endsection