<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ Setting::get('app.short_name') }} | {{ $page_title or "Page Title" }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Set a meta reference to the CSRF token for use in AJAX request -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Material Design fonts -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    {{-- <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons"> --}}

    <link rel="stylesheet" type="text/css" href="{{ asset("/bower_components/admin-lte/material-design-icons/iconfont/material-icons.css") }}">

    <!-- Bootstrap 3.3.4 -->
    <link href="{{ asset("/bower_components/admin-lte/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />

    <!-- jQuery UI -->
    <link href="{{ asset("/bower_components/admin-lte/plugins/jQueryUI/jquery-ui-1.12.1/jquery-ui.min.css") }}" rel="stylesheet" />

    <!-- Bootstrap Material Design to be included-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset("/bower_components/admin-lte/bootstrap-material-design/dist/css/bootstrap-material-design.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("/bower_components/admin-lte/bootstrap-material-design/dist/css/ripples.min.css") }}"> --}} 

    <!-- Font Awesome Icons 4.4.0 -->
    <link href="{{ asset("/bower_components/admin-lte/font-awesome/css/font-awesome.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.1 -->
    <link href="{{ asset("/bower_components/admin-lte/ionicons/css/ionicons.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset("/bower_components/admin-lte/dist/css/AdminLTE.min.css") }}" rel="stylesheet" type="text/css" />

    <!-- Application CSS-->
    <link href="{{ asset(elixir('css/all.css')) }}" rel="stylesheet" type="text/css" />

    <!-- @cpnwaugha jQuery Toast -->
    <link href="{{ asset("/bower_components/admin-lte/dist/css/jquery.toast.css") }}" rel="stylesheet" type="text/css" />

    <!-- @cpnwaugha Sleek select using propeller.js -->

    <!-- Select2 css -->
    <link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/plugins/propellerkit/components/select2/css/select2.min.css") }}">
    <link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/plugins/propellerkit/components/select2/css/select2-bootstrap.css") }}" >
    <!-- Propeller typography -->
    <link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/plugins/propellerkit/assets/css/typography.css") }}">
    <!-- Propeller text fields -->
    <link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/plugins/propellerkit/components/textfield/css/textfield.css") }}"  >
    <!-- Propeller select2 -->
    {{-- <link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/plugins/propellerkit/components/select2/css/pmd-select2.css") }}" > --}}
    <!-- AdminLTE select2 -->
    <link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/select2/dist/css/select2.min.css") }}" >

    <!-- MUI -->
    <link href="{{ asset("/bower_components/admin-lte/mui/css/mui.min.css") }}" rel="stylesheet" type="text/css" />


    <script src="{{ asset("/bower_components/admin-lte/mui/js/mui.min.js") }}"></script>

    <link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/plugins/propellerkit/components/select2/css/pmd-select2.css") }}" >
    <link rel="stylesheet" type="text/css" href="{{asset('/bower_components/admin-lte/plugins/datatables/jquery.dataTables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('/bower_components/admin-lte/plugins/datatables/material.min.css') }}"> 
    <link rel="stylesheet" type="text/css" href="{{asset('/bower_components/admin-lte/plugins/datatables/dataTables.material.min.css') }}">  
  
    
    <!-- Head -->
    @include('partials._head')

      <!-- REQUIRED JS SCRIPTS -->

      <!-- jQuery 2.1.4 -->
      <script src="{{ asset ("/bower_components/admin-lte/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script>
      <!-- Bootstrap 3.3.2 JS -->
      <script src="{{ asset ("/bower_components/admin-lte/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
      <!-- JQuery UI js-->
      <script src="{{ asset("/bower_components/admin-lte/plugins/jQueryUI/jquery-ui-1.12.1/jquery-ui.min.js") }}"></script>
      <!-- AdminLTE App -->
      <script src="{{ asset ("/bower_components/admin-lte/dist/js/app.min.js") }}" type="text/javascript"></script>
      <!-- @cpnwaugha jQuery Toast -->
      <script src="{{ asset ("/bower_components/admin-lte/dist/js/jquery.toast.js") }}" type="text/javascript"></script>

      

      
      <!-- Additional jQuery here. Note that some more jQuery for layout designs are in patials._body.blade.php-->

      {{-- <script src="{{asset("/bower_components/admin-lte/plugins/propellerkit/components/textfield/js/textfield.js")}}"></script>
      <script src="{{asset("/bower_components/admin-lte/plugins/propellerkit/components/select2/js/select2.full.js")}}"  ></script>
      <script src="{{asset("/js/custom.js")}}"></script>
      <script src="{{asset("/bower_components/admin-lte/plugins/propellerkit/components/select2/js/pmd-select2.js")}}"></script> --}}

      <!-- AdminLTE Select2 -->
      <script src="{{asset("/bower_components/admin-lte/select2/dist/js/select2.full.min.js")}}"></script>

      <script type="text/javascript" src="{{ asset('/bower_components/admin-lte/plugins/datatables/jquery.dataTables.js') }}"></script>
      <script type="text/javascript" src="{{ asset('/bower_components/admin-lte/plugins/datatables/dataTables.material.min.js') }}"></script>

      <!-- Optionally, you can add Slimscroll and FastClick plugins.
            Both of these plugins are recommended to enhance the
            user experience. Slimscroll is required when using the
            fixed layout. -->

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

      <!-- Application JS-->
      <script src="{{ asset(elixir('js/all.js')) }}"></script>

      <!-- Optional header section  -->
      @yield('head_extra')

  </head>

  <!-- Body -->
  @include('partials._body')

</html>
