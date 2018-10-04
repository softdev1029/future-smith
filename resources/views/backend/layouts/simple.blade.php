<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <script type="text/javascript">
        var config_file_uploads = {
            'url':              '{{ route('file.upload') }}',
            'max_count':        '{{ Config::get('settings.uploads.max_count') }}',
        };
    </script>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/global.js') }}" defer></script>


    <script src="{{ asset('plugins/jquery-cookie/src/jquery.cookie.js') }}" defer></script>
    <script src="{{ asset('plugins/admin/js//grasp_mobile_progress_circle-1.0.0.min.js') }}" defer></script>
    <script src="{{ asset('plugins/malihu-scrollbar/jquery.mCustomScrollbar.js') }}" defer></script>

    @stack('scripts')

    <script src="{{ asset('plugins/admin/js/default.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="{{ asset('css/fonts/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">

    <!-- Plugin CSS -->
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="{{ asset('plugins/admin/css/grasp_mobile_progress_circle-1.0.0.min.css') }}">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="{{ asset('plugins/malihu-scrollbar/jquery.mCustomScrollbar.min.css') }}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('plugins/admin/css/style.default.css') }}" id="theme-stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">
    <link href="{{ asset('css/backend/common.css') }}" rel="stylesheet">
    <link href="{{ asset('css/backend/auth/login.css') }}" rel="stylesheet">

    @stack('stylesheets')
</head>
<body class="page-{{ $page_key }}">
<div class="page login-page">
    <div class="container">
        @yield('content')
    </div>
</div>
</body>
</html>
