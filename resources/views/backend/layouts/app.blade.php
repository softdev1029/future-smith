<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Bootstrap Core CSS -->
  <link href="{{ asset('backend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- MetisMenu CSS -->
  <link href="{{ asset('backend/vendor/metisMenu/metisMenu.min.css') }}" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="{{ asset('backend/dist/css/sb-admin-2.css') }}" rel="stylesheet">

  <!-- Morris Charts CSS -->
  <link href="{{ asset('backend/vendor/morrisjs/morris.css') }}" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="{{ asset('backend/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

  @stack('stylesheets')
</head>

<body>
  <div id="wrapper">

    <!-- Navigation -->
    @include('backend.layouts.partials.navigation')

    @yield('content')

  </div>
  <footer class="main-footer">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <p>{{ env('APP_NAME') }} &copy; {{ date('Y') }}</p>
        </div>
        <div class="col-sm-6 text-right">
        </div>
      </div>
    </div>
  </footer>
  <!-- /#wrapper -->

  <!-- jQuery -->
  <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

  <!-- Metis Menu Plugin JavaScript -->
  <script src="{{ asset('backend/vendor/metisMenu/metisMenu.min.js') }}"></script>

  @stack('scripts')

  <!-- Custom Theme JavaScript -->
  <script src="{{ asset('backend/dist/js/sb-admin-2.js') }}"></script>
</body>

</html>
