@extends('app')


@section('plugins')
<link href="{{ asset('/layui/css/layui.css') }}" rel='stylesheet' media="all" type='text/css'>

@endsection

@section('content')
<div>
	<div class="page-title">
		<div class="title_left">
			<h3>图片分类管理</h3>
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
			<th>分类标题</th>
			<th>是否启用</th>
			<th>分类描述</th>
			<th>添加时间</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		
		@foreach($imageCategory as $category)

		<tr>
			<th>{{ $category->id }}</th>
			<th>{{ $category->c_name }}</th>
			@if($category->c_status == 0)
				<th>禁用</th>
			@else
				<th>可用</th>
			@endif
			<th>{{ $category->c_desc }}</th>
			<th>{{ $category->created_at }}</th>
			<th>操作</th>
		</tr>

		@endforeach
		
	</tbody>
</table>
@endsection

@section('Jsplugins')
<!-- <script type="text/javascript" src="{{ asset('/layer/layer.js') }}"></script> -->
@endsection