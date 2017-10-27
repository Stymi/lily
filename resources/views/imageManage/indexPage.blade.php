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

                <div class="row">

                    <div class="col-md-55">
                        <div class="thumbnail">
                            <div class="image view view-first">
                                <img style="width: 100%; display: block;" src="{{ asset('images/media.jpg') }}" alt="image" />
                                <div class="mask">
                                    <p>Your Text</p>
                                    <div class="tools tools-bottom">
                                        <a href="#">
                                            <i class="fa fa-link"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="caption">
                                <p>Snow and Ice Incoming for the South</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-55">
                        <div class="thumbnail">
                            <div class="image view view-first">
                                <img style="width: 100%; display: block;" src="{{ asset('images/media.jpg') }}" alt="image" />
                                <div class="mask">
                                    <p>Your Text</p>
                                    <div class="tools tools-bottom">
                                        <a href="#">
                                            <i class="fa fa-link"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="caption">
                                <p>Snow and Ice Incoming for the South</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-55">
                        <div class="thumbnail">
                            <div class="image view view-first">
                                <img style="width: 100%; display: block;" src="{{ asset('images/media.jpg') }}" alt="image" />
                                <div class="mask">
                                    <p>Your Text</p>
                                    <div class="tools tools-bottom">
                                        <a href="#">
                                            <i class="fa fa-link"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="caption">
                                <p>Snow and Ice Incoming for the South</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-55">
                        <div class="thumbnail">
                            <div class="image view view-first">
                                <img style="width: 100%; display: block;" src="{{ asset('images/media.jpg') }}" alt="image" />
                                <div class="mask">
                                    <p>Your Text</p>
                                    <div class="tools tools-bottom">
                                        <a href="#">
                                            <i class="fa fa-link"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="caption">
                                <p>Snow and Ice Incoming for the South</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-55">
                        <div class="thumbnail">
                            <div class="image view view-first">
                                <img style="width: 100%; display: block;" src="{{ asset('images/media.jpg') }}" alt="image" />
                                <div class="mask">
                                    <p>Your Text</p>
                                    <div class="tools tools-bottom">
                                        <a href="#">
                                            <i class="fa fa-link"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="caption">
                                <p>Snow and Ice Incoming for the South</p>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('Jsplugins')
<!-- <script type="text/javascript" src="{{ asset('/layer/layer.js') }}"></script>
-->
@endsection