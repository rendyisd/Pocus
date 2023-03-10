<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(
        ['resources/sass/app.scss',
        'resources/sass/home.scss',
        'resources/js/app.js',
        'resources/js/flashcards.js']
    )
</head>
<body>
    <div id="app position-relative">
        <div class="bg-image"></div>
        <div class="bg-image-gradient"></div>
            
        </div>
        <nav class="navbar navbar-dark">
            <div class="container">
                <a class="navbar-brand ms-1" href="{{ url('/') }}" style="font-size: 1.8rem">
                    <i class="fa-regular fa-square-check"></i>
                    <span class="ms-1" style="font-weight: 700;">POCUS</span>
                </a>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto flex-row">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="btn btn-light me-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="btn btn-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu position-absolute dropdown-menu-end" aria-labelledby="navbarDropdown" style="background-color: rgba(0, 0, 0, 0.3);">
                                <a class="dropdown-item text-light" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>

            </div>
        </nav>

        <main class="main-content">
            @yield('content')
        </main>
    </div>
</body>
</html>
