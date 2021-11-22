<!DOCTYPE html>
<!--
Beyond Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 3
Version: 1.3
Purchase: http://wrapbootstrap.com
-->

<html xmlns="http://www.w3.org/1999/xhtml">
<!--Head-->
<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }} | @yield('title')</title>

    <meta name="description" content="@yield('title')" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="{{asset('/img/favicon.png')}}" type="image/x-icon">

    <!--Basic Styles-->
    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link id="bootstrap-rtl-link" href="" rel="stylesheet" />
    <link href="{{asset('/css/font-awesome.min.css')}}" rel="stylesheet" />

    <!--Fonts-->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300" rel="stylesheet" type="text/css">

    <!--Beyond styles-->
    <link href="{{asset('/css/beyond.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/css/demo.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/css/animate.min.css')}}" rel="stylesheet" />
    <link id="skin-link" href="" rel="stylesheet" type="text/css" />

    @hasSection('page_style')
        @yield('page_style')
    @endif
    <style type="text/css">
        .input-small{
            width: 100% !important;
        }
    </style>
    <script src="{{asset('/js/skins.min.js')}}"></script>
</head>
<!--Head Ends-->
<!--Body-->
<body>
    <!-- Loading Container -->
    <div class="loading-container">
        <div class="loader"></div>
    </div>
    @hasSection('nav')
        @yield('nav')
    @endif
    @hasSection('content')
        @yield('content')
    @endif
    <!--Basic Scripts-->
    <script src="{{asset('/js/jquery-2.0.3.min.js')}}"></script>
    <script src="{{asset('/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/js/slimscroll/jquery.slimscroll.min.js')}}"></script>

    <!--Beyond Scripts-->
    <script src="{{asset('/js/beyond.js')}}"></script>

    @hasSection('script')
        @yield('script')
    @endif
</body>
<!--Body Ends-->
</html>
