@extends('app')


@section('plugins')
<link href="{{ asset('/layui/css/layui.css') }}" rel='stylesheet' media="all" type='text/css'>

@endsection

@section('content')
<div>
	<div class="page-title">
		<div class="title_left">
			<h3>直播室管理</h3>
		</div>

	</div>
</div>

<table class="layui-table" lay-even="" lay-skin="row">
	<colgroup>
	<col width="10%">
	<col width="15%">
	<col width="10%">
	<col width="10%">
	<col width="30%">
	<col width="15%">
	<col width="10%">
	</colgroup>
	<thead>
		<tr>
			<th>ID</th>
			<th>名称</th>
			<th>主管理</th>
			<th>状态</th>
			<th>描述</th>
			<th>添加时间</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody id="roomData">
		
		
	</tbody>
</table>

<fieldset class="layui-elem-field layui-field-title" id="demo1" style="margin-top: 20px;">
	</fieldset>
@endsection

@section('Jsplugins')
<script type="text/javascript" src="{{ asset('/layui/layui.js') }}"></script>

<script type="text/javascript">
	layui.use(['laypage', 'layer'], function(){
	  	var laypage = layui.laypage
	  	,layer = layui.layer;

	  	laypage({
		    cont: 'demo1'
		    ,groups: 5 //连续显示分页数
		  	,pages: {{ $cp->page }} //总页数
		    ,count: {{ $cp->count }}
		    ,limit : 10
		    ,curr : 1
		    ,layout: ['prev', 'next']
		    ,jump : function(obj, first){
		    	$.ajax({
					url : "{{ URL::to('roomManage/roomListPaging') }}",
				    type : "POST",
				    dataTpye : "json",
				    data : {
				    	limit : obj.limit,
				    	offset : obj.curr,
				    },
				    success:function(data){
				    	var res = eval('(' + data + ')');
				    	var a = '';

				    	for (var i = res.list.length - 1; i >= 0; i--) {
				    		a += '<tr>';
				    		a += '<td>'+res.list[i].id+'</td>';
				    		a += '<td>'+res.list[i].name+'</td>';
				    		a += '<td>'+res.list[i].expertid+'</td>';
				    		a += '<td>'+res.list[i].status+'</td>';
				    		a += '<td>'+res.list[i].msg+'</td>';
				    		a += '<td>'+res.list[i].created_at+'</td>';
				    		a += '<td>操作</td>';
				    		a += '</tr>';
				    	}

				    	$("#roomData").html(a);
				    }
				})
		    }
	  	});
	});
</script>
@endsection