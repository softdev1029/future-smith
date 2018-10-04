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

    <script src="{{ asset('plugins/jquery-1.11.3.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-form/dist/jquery.form.min.js') }}" defer></script>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/global.js') }}" defer></script>
    <script src="{{ asset('js/header.js') }}" defer></script>

    @stack('scripts')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Assistant" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="{{ asset('css/fonts/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend/common.css') }}" rel="stylesheet">

    @stack('stylesheets')
</head>
<body class="page-{{ $page_key }}">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @include('layouts.partials.top_menu')

                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item signup-or-login px-4 ml-3">
                              <a class="nav-link signup-link" href="{{ route('register') }}">{{ __('Sign Up') }}</a> or
                              <a class="nav-link sigin-link" href="{{ route('login') }}">{{ __('Log in') }}</a>
                            </li>
                        @else

                            <li class="nav-item dropdown notifications">
                                <a id="navbarNotificationDropdown" href="#" class="nav-link" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i class="far fa-bell"></i></a>
                                @include('layouts.partials.notifications')
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if ($current_user->image())
                                    <img src="{{ file_url($current_user->image()) }}" class="img-fluid rounded-circle mr-2" width="30" />
                                    @endif

                                    {{ $current_user->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.edit') }}">Profile</a>
                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <div class="site-footer">
          <h2 class="my-3 py-4">Some of our past collaborators</h2>
          <p class="py-2">We have worked with several organisations in the aging and volunteering sectors in the development of Future Smith.</p>
          <div class="py-3 footer-images">
            <img class="odd" src="{{ asset('images/home/footer-mark-1.png') }}" />
            <img class="even" src="{{ asset('images/home/footer-mark-2.png') }}" />
            <img class="odd"  src="{{ asset('images/home/footer-mark-1.png') }}" />
            <img class="even" src="{{ asset('images/home/footer-mark-2.png') }}" />
            <img class="odd" src="{{ asset('images/home/footer-mark-1.png') }}" />
            <img class="even" src="{{ asset('images/home/footer-mark-2.png') }}" />
          </div>
          <h4 class="py-4">Future Smith 2018  |   All Rights Reserved </h4>
        </div>
    </div>
</body>
</html>
