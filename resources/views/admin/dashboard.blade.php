@extends('layout.app')

@section('title', 'Admin Dashboard')

@section('nav')
    <!-- Navbar -->
    <div class="navbar">
        <div class="navbar-inner" style="z-index: 999;">
            <div class="navbar-container">
                <!-- Navbar Barnd -->
                <div class="navbar-header pull-left">
                    <a href="#" class="navbar-brand">
                        <small>
                            <img src="{{ asset('/img/logo.png')}}" alt="" />
                        </small>
                    </a>
                </div>
                <!-- /Navbar Barnd -->
                <!-- Sidebar Collapse -->
                <div class="sidebar-collapse" id="sidebar-collapse">
                    <i class="collapse-icon fa fa-bars"></i>
                </div>
                <!-- /Sidebar Collapse -->
                <!-- Account Area and Settings --->
                <div class="navbar-header pull-right">
                    <div class="navbar-account">
                        <ul class="account-area">
                            <li>
                                <a class="" title="Sign Out" href="{{ url('logout') }}">
                                    <i class="icon fa fa-sign-out"></i>
                                </a>
                                
                            </li>
                            <!-- /Account Area -->
                            <!--Note: notice that setting div must start right after account area list.
                            no space must be between these elements-->
                            <!-- Settings -->
                        </ul>
                </div>
                <!-- /Account Area and Settings -->
            </div>
        </div>
    </div>
    <!-- /Navbar -->

@endsection

@section('nav')


@section('content')

<!-- Main Container -->
    <div class="main-container container-fluid">
        <!-- Page Container -->
        <div class="page-container">
            <!-- Page Sidebar -->
            <div class="page-sidebar" id="sidebar">
                <!-- Sidebar Menu -->
                <ul class="nav sidebar-menu">
                    <!--Dashboard-->
                    <li class="active">
                        <a href="{{ url('dashboard') }}">
                            <i class="menu-icon glyphicon glyphicon-home"></i>
                            <span class="menu-text"> Dashboard </span>
                        </a>
                    </li>
                    <!--Databoxes-->
                    <li>
                        <a href="{{ url('/admin/products') }}">
                            <i class="menu-icon fa fa-th"></i>
                            <span class="menu-text"> Products </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/users') }}">
                            <i class="menu-icon fa fa-user"></i>
                            <span class="menu-text"> User </span>
                        </a>
                    </li>
                    <!--UI Elements-->
                    <li>
                        <a href="#" class="menu-dropdown">
                            <i class="menu-icon fa fa-list"></i>
                            <span class="menu-text"> Masters </span>

                            <i class="menu-expand"></i>
                        </a>

                        <ul class="submenu">
                            <li>
                                <a href="{{ url('admin/locations') }}">
                                    <span class="menu-text">Locations</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/product_types')}}">
                                    <span class="menu-text">Product Types</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
                <!-- /Sidebar Menu -->
            </div>
            <!-- /Page Sidebar -->
            <!-- Page Content -->
            <div class="page-content">
                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="#">Home</a>
                        </li>
                        <li class="active">Dashboard</li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->
                <!-- Page Header -->
                <div class="page-header position-relative">
                    <div class="header-title">
                        <h1>
                            Dashboard
                        </h1>
                    </div>
                    <!--Header Buttons-->
                    <div class="header-buttons">
                        <a class="sidebar-toggler" href="#">
                            <i class="fa fa-arrows-h"></i>
                        </a>
                        <a class="refresh" id="refresh-toggler" href="">
                            <i class="glyphicon glyphicon-refresh"></i>
                        </a>
                        <a class="fullscreen" id="fullscreen-toggler" href="#">
                            <i class="glyphicon glyphicon-fullscreen"></i>
                        </a>
                    </div>
                    <!--Header Buttons End-->
                </div>
                <!-- /Page Header -->
                <!-- Page Body -->
                <div class="page-body">
                    <!-- Your Content Goes Here -->
                </div>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->
        </div>
        <!-- /Page Container -->
        <!-- Main Container -->

    </div>
@endsection

@section('script')

<script type="text/javascript">
    $(document).ready(function(){

    });
</script>

@endsection