<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>名嘉金服</title>

	<!-- Bootstrap -->
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Custom Theme Style 侧边栏 -->
    <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">

    @yield('plugins')
</head>
<body class="nav-md footer_fixed">

	<div class="container body">
        <div class="main_container">

        	<div class="col-md-3 left_col">

		        @include('left')

		        @include('top')

		        <div class="right_col" role="main">
		        	@yield('content')
		        </div>

		        <!-- footer content -->
                <footer>
                    <div class="pull-right">
                        Kentirry - KaPserver Super Admin Panel
                        - Design By ぃ.一往无悔
                    </div>
                    <div class="clearfix"></div>
                </footer>

        	</div>


        </div>
    </div>

</body>
<script type="text/javascript" src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('build/js/custom.min.js') }}"></script>

@yield('Jsplugins')
</html>