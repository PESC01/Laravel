<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('build/assets/app-041e359a.css') }}">
    <script src="{{ asset('build/assets/app-c75e0372.js') }}"></script>

    <style>
        .navbar-custom .nav-link,
        .navbar-custom .navbar-brand {
            /* Agregamos navbar-brand aquí */
            color: white !important;
            font-weight: bold;
            letter-spacing: 0.05em;
            transition: all 0.3s ease;
        }

        /* Efecto de iluminación al pasar el mouse */
        .navbar-custom .nav-link:hover,
        .navbar-custom .navbar-brand:hover {
            /* Agregamos navbar-brand:hover aquí */
            color: #ffffff !important;
            text-shadow: 0 0 10px #ffffff,
                0 0 20px #ffffff,
                0 0 30px #ffffff;
            transform: scale(1.1);
        }
    </style>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-custom shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                                </li>
                            @endif
                        @else
                            @php($logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout'))
                            @php($profile_url = View::getSection('profile_url') ?? config('adminlte.profile_url', 'login'))

                            <li class="nav-item dropdown user-menu">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    @if (config('adminlte.usermenu_image'))
                                        <img src="{{ Auth::user()->adminlte_image() }}"
                                            class="user-image img-circle elevation-2" alt="{{ Auth::user()->name }}">
                                    @endif
                                    <span @if (config('adminlte.usermenu_image')) class="d-none d-md-inline" @endif>
                                        {{ Auth::user()->name }}
                                        <small>({{ Auth::user()->getRoleNames()->first() }})</small>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                    @if (config('adminlte.usermenu_header'))
                                        <li
                                            class="user-header {{ config('adminlte.usermenu_header_class', 'bg-primary') }}">
                                            @if (config('adminlte.usermenu_image'))
                                                <img src="{{ Auth::user()->adminlte_image() }}"
                                                    class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
                                            @endif
                                            <p>
                                                {{ Auth::user()->name }}
                                                <small>{{ Auth::user()->getRoleNames()->first() }}</small>
                                            </p>
                                        </li>
                                    @endif
                                    <li class="user-footer">
                                        <a class="btn btn-default btn-flat float-right" href="#"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('adminlte::adminlte.log_out') }}
                                        </a>
                                        <form id="logout-form" action="{{ $logout_url }}" method="POST"
                                            style="display: none;">
                                            @if (config('adminlte.logout_method'))
                                                {{ method_field(config('adminlte.logout_method')) }}
                                            @endif
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
