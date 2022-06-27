<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" >
        <title>Employee</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href=" https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.1/css/fontawesome.min.css">

        <!--        plugins/fontawesome-free/css/all.min.css-->
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
 <!----  toastr  ---->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>


        <!-- JQVMap -->
        <link rel="stylesheet" href="{{ asset('public/plugins/jqvmap/jqvmap.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('public/dist/css/adminlte.min.css') }}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href=" {{ asset('public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }} ">
        <!-- Daterange picker -->
        <link rel="stylesheet" href=" {{ asset('public/plugins/daterangepicker/daterangepicker.css') }}  ">
        <!-- summernote -->
        <link rel="stylesheet" href=" {{ asset('public/plugins/summernote/summernote-bs4.min.css') }}">
        <link rel="stylesheet" href=" {{ asset('public/plugins/daterangepicker/daterangepicker.css') }}">
        <!-- Front awesome support -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

        <!--        datatable css jquery-->
        <!--        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css"/>
                <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>-->

        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script src="{{ asset('public/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

        <!--        bootstrap datepicker-->
        <!--       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" />-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <!-- Jquery support for datePicker -->
        <link rel="stylesheet" href="{{ asset('public/dist/css/jquery-ui.css') }}">
<!--        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->



        <link rel="stylesheet" type="text/css" href="{{asset('public/DataTables/datatables.min.css')}}"/>
        <script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>
<!--          <script type="text/javascript" src="{{asset('public/DataTables/datatables.min.js')}}"></script>-->
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href=" {{ asset('public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

        <!-- iCheck -->
        <link rel="stylesheet" href=" {{ asset('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }} ">
    </head>


