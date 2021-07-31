<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/assets/images/icon.png') }}">
    <title>{{ config('app.name', 'Auth') }}</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('public/assets/admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('public/assets/admin/css/style.css') }}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset('public/assets/admin/css/colors/blue.css') }}" id="theme" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/assets/admin/images/icon.png') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

    <style>
        .custom-select.is-invalid,
        .form-control.is-invalid,
        .was-validated .custom-select:invalid,
        .was-validated .form-control:invalid {
            border-color: #e3342f;
        }

        .invalid-feedback {
            width: 100%;
            margin-top: .25rem;
            font-size: 80%;
            color: #e3342f;
        }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <section id="wrapper">
        @yield('content')
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('public/assets/admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('public/assets/admin/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/assets/admin/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('public/assets/admin/js/jquery.slimscroll.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('public/assets/admin/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('public/assets/admin/js/sidebarmenu.js') }}"></script>
    <!--stickey kit -->
    <script src="{{ asset('public/assets/admin/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <!--script src="{{ asset('public/assets/admin/plugins/sparkline/jquery.sparkline.min.js') }}"></script-->
    <!--Custom JavaScript -->
    <script src="{{ asset('public/assets/admin/js/custom.min.js') }}"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{ asset('public/assets/admin/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>
</body>

</html>