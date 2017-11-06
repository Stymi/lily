@extends('app')


@section('plugins')
<link href="{{ asset('/layui/css/layui.css') }}" rel='stylesheet' media="all" type='text/css'>
@endsection

@section('content')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>图片管理</h3>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="x_panel">

            <div class="x_content">

                <div class="row" id="layer-photos">
                    @foreach($imagelist as $image)
                    <div class="col-md-55" id="image_{{$image->id}}">
                        <div class="thumbnail">
                            <div class="image view view-first">
                                <img style="display: block;" src="{{ asset($image->url) }}-live" layer-src="{{ asset($image->url) }}-live" alt="image" />
                                <div class="mask">
                                    <p>&nbsp;</p>
                                    <div class="tools tools-bottom">
                                        <a href="#"> <i class="fa fa-link"></i>
                                        </a>
                                        <a href="javascript:;" onclick="deleteimage('{{ $image->imgkey }}',{{ $image->id }},'{{ $image->title }}')">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="caption" style="height: 60px;">
                                <p>{{ $image->title }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('Jsplugins')
<script type="text/javascript" src="{{ asset('/layui/layui.js') }}"></script>
<script type="text/javascript">

    layui.use(['layer'],function(){

        layer.photos({
            photos: '#layer-photos'
            ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
        }); 

    })
    
    function deleteimage(key,id,title) {
        layer.confirm('确定删除图片【'+title+'】?', {icon: 3, title:'提示'}, function(index){
            var load = layer.load(2);
            $.ajax({
                url : "{{ URL::to('imageManage/deleteImageFile') }}",
                type : "POST",
                dataTpye : "json",
                data : {
                    key : key,
                    id : id
                },
                headers : {
                    'X-CSRF-TOKEN' : $('meta[name="_token"]').attr('content')
                },
                success:function(res){
                    var obj = eval('(' + res + ')');

                    if (obj.statusCode == 1) {
                        layer.msg("删除成功",{icon : 1});
                        $("#image_"+id).remove();
                    }else{
                        layer.msg(obj.statusMsg,{icon : 2});
                    }

                    layer.close(load);
                },
                error:function(err){
                    layer.msg("提交失败", {icon: 0});
                    layer.close(load);
                }
            })
            layer.close(index);
        });
        
    }


</script>
@endsection