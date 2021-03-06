@extends('app')


@section('plugins')
<link href="{{ asset('/layui/css/layui.css') }}" rel='stylesheet' media="all" type='text/css'>

@endsection

@section('content')
<div>
	<div class="page-title">
		<div class="title_left">
			<h3>普通用户账号管理</h3>
		</div>

	</div>
</div>

<table class="layui-table" lay-even="" lay-skin="row">
	<colgroup>
	<col width="10%">
	<col width="20%">
	<col width="20%">
	<col width="10%">
	<col width="15%">
	<col width="15%">
	<col width="10%">
	</colgroup>
	<thead>
		<tr>
			<th>ID</th>
			<th>账号</th>
			<th>名称</th>
			<th>状态</th>
			<th>直播室</th>
			<th>添加时间</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	
		
	</tbody>
</table>
@endsection

@section('Jsplugins')
<!-- <script type="text/javascript" src="{{ asset('/layer/layer.js') }}"></script> -->
@endsection