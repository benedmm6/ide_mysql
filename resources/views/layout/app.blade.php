<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IDE - @yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url("plugins/fontawesome-free/css/all.min.css")}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url("css/adminlte.min.css")}}">
</head>

<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  
    <!-- Navbar -->
    @section('navbar')
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>     
    @show
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->

    @section('sidebar')
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('admin.databases.index') }}" class="brand-link">
                <img src="{{ url("img/logo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-light">AdminDBA</span>
            </a>
        
            <!-- Sidebar -->
            <div class="sidebar">
        
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->

                        <li class="nav-header">Administración</li>

                        <li class="nav-item">
                          <a href="{{ route('admin.databases.index') }}" class="nav-link">
                              <i class="nav-icon fas fa-home"></i>
                              <p>Inicio</p>

                          </a>

                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.databases.create') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Nueva base de datos</p>

                            </a>

                        </li> 

                        <li class="nav-header">Bases de datos</li>

                        @foreach ($dbs as $db)

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.databases.edit', $db->name)}}">
                                <i class="fas fa-database"></i>
                                {{-- <span data-feather="file-text"></span> --}}
                                {{ $db->name }}
                            </a>
                        </li>
                        
                    @endforeach
                                
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        
    @show
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    @yield('content-header')

    <!-- Main content -->
    <section class="content">

        @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @section('footer')
  <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2022 AdminDBA.</strong> All rights reserved.
    </footer>   
  @show

  
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ url("plugins/jquery/jquery.min.js")}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url("plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{ url("js/adminlte.min.js")}}"></script>
<!-- Customs js app -->
<script src="{{ url("js/app/createTable.js")}}"></script>
</body>
</html>
