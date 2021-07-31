<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Dashboard</title>
  <!-- Custom CSS -->
  <link href="{{ asset('public/assets/admin/css/style.css') }}" rel="stylesheet">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('public/assets2/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('public/assets2/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('public/assets2/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('public/assets2/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/assets2/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('public/assets2/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('public/assets2/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('public/assets2/plugins/summernote/summernote-bs4.min.css')}}">
  @yield('pageCss')

  <style>
    .dataTables_wrapper .dataTables_processing {
      background: rgba(0, 0, 0, 0.7) none repeat scroll 0 0 !important;
      height: 100% !important;
      left: 0 !important;
      margin-left: 0px !important;
      margin-top: 0 !important;
      padding-top: 20px;
      position: fixed !important;
      text-align: center;
      top: 0;
      width: 100% !important;
      z-index: 999999;
    }

    .dataTables_processing>img {
      background: #ffffff none repeat scroll 0 0;
      border-radius: 8px;
      height: 120px;
      padding: 10px;
      position: relative;
      top: 40%;
      width: 120px;
    }

    .dataTables_processing>img {
      background: #ffffff none repeat scroll 0 0;
      border-radius: 8px;
      height: 120px;
      padding: 10px;
      position: relative;
      top: 40%;
      width: 120px;
    }

    #dataTable_paginate {
      display: none;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="{{ asset('public/assets2/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    @include('companies.includes.topbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('companies.includes.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        @yield('content')
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ asset('public/assets2/plugins/jquery/jquery.min.js')}}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('public/assets2/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('public/assets2/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- ChartJS -->
  <script src="{{ asset('public/assets2/plugins/chart.js/Chart.min.js')}}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('public/assets2/plugins/sparklines/sparkline.js')}}"></script>
  <!-- JQVMap -->
  <script src="{{ asset('public/assets2/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
  <script src="{{ asset('public/assets2/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('public/assets2/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('public/assets2/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('public/assets2/plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('public/assets2/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <!-- Summernote -->
  <script src="{{ asset('public/assets2/plugins/summernote/summernote-bs4.min.js') }}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('public/assets2/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('public/assets2/dist/js/adminlte.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('public/assets2/dist/js/demo.js') }}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('public/assets2/dist/js/pages/dashboard.js') }}"></script>







  <!-- Data Table ---->
    <!--script type="text/javascript" src="{{ asset('public/assets/admin/plugins/data-tables/js/data-table.min.js') }}"></script-->
    <script type="text/javascript" src="{{ asset('public/assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/admin/plugins/datatables/extra-plugins/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/admin/plugins/datatables/extra-plugins/buttons.html5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/admin/plugins/datatables/extra-plugins/buttons.colVis.min.js') }}"></script>


    <!--script src="{{ asset('public/assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script-->


    <!-- SweetAlert -->
    <script type="text/javascript" src="{{ asset('public/assets/admin/plugins/sweetalert/sweetalert2.min.js') }}"></script>

    <!-- Switcher Js -->
    <script src="{{ asset('public/assets/admin/plugins/switchery/dist/switchery.min.js') }}"></script>
    <!-- Style switcher -->
    <script src="{{ asset('public/assets/admin/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>

    <!-- summernotes JS -->
    <script src="{{ asset('public/assets/admin/plugins/summernote/dist/summernote.min.js') }}"></script>
        <!-- Range Date picker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
  

    

    
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--sparkline JavaScript -->
    <!--script src="../assets/plugins/sparkline/jquery.sparkline.min.js"></script-->
    <!--morris JavaScript -->
    <!--script src="../assets/plugins/raphael/raphael-min.js"></script-->
    <!--script src="../assets/plugins/morrisjs/morris.min.js"></script-->
    <!-- Chart JS -->
    <!--script src="js/dashboard1.js"></script-->
    <!-- ============================================================== -->
    <!-- Include page js script here -->
    @yield('pagejs')
    <script>
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
    </script>
</body>

</html>