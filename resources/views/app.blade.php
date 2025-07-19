<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap"
        rel="stylesheet">
    <link href="{{ asset('src/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('src/css/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('src/css/main.css') }}" rel="stylesheet">
</head>

<body id="top">
    <main>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <i class="bi-mortarboard text-white"></i>
                    <span class="text-white">eMock.uz</span>
                </a>

                <div class="d-lg-none ms-auto me-4">
                    <a href="/dashboard" class="navbar-icon bi-person smoothscroll"></a>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-lg-5 me-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link click-scroll"
                                href="/terms">{{ __('messages.link_terms_of_service') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link click-scroll"
                                href="/privacy">{{ __('messages.link_privacy_policy') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link click-scroll"
                                href="/cookies">{{ __('messages.link_cookies_policy') }}</a>
                        </li>
                    </ul>

                    <div class="d-none d-lg-flex align-items-center gap-3">
                        <!-- Theme Toggle Button -->
                        <button id="theme-toggle"
                            class="btn btn-light rounded-circle d-flex align-items-center justify-content-center"
                            type="button" aria-label="Toggle dark mode">
                            <i id="theme-toggle-icon" class="bi bi-moon" style="font-size: 1.25rem;"></i>
                        </button>

                        <!-- Profile Icon -->
                        <button class="btn btn-light rounded-circle d-flex align-items-center justify-content-center"
                            aria-label="Profile" onclick="window.location.href='/dashboard'">
                            <i class="bi bi-person" style="font-size: 1.25rem;"></i>
                        </button>

                        <!-- Language Dropdown -->
                        <div class="dropdown">
                            <button class="btn dropdown-toggle d-flex align-items-center gap-2 px-3 py-1 rounded-pill"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @php
                                    $locale = session('locale', app()->getLocale());
                                    $flags = ['en' => 'gb', 'uz' => 'uz', 'ru' => 'ru'];
                                @endphp
                                <span class="fi fi-{{ $flags[$locale] ?? 'gb' }}"
                                    style="width: 1.7em; height: 1.2em; background-size: cover; background-image: url('https://cdn.jsdelivr.net/npm/flag-icons@6.7.0/flags/4x3/{{ $flags[$locale] ?? 'gb' }}.svg');"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2"
                                        href="{{ route('lang.switch', ['lang' => 'uz']) }}">
                                        <span class="fi fi-uz"
                                            style="width: 1.7em; height: 1.2em; background-size: cover; background-image: url('https://cdn.jsdelivr.net/npm/flag-icons@6.7.0/flags/4x3/uz.svg');"></span>
                                        O'zbek
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2"
                                        href="{{ route('lang.switch', ['lang' => 'ru']) }}">
                                        <span class="fi fi-ru"
                                            style="width: 1.7em; height: 1.2em; background-size: cover; background-image: url('https://cdn.jsdelivr.net/npm/flag-icons@6.7.0/flags/4x3/ru.svg');"></span>
                                        Русский
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2"
                                        href="{{ route('lang.switch', ['lang' => 'en']) }}">
                                        <span class="fi fi-gb"
                                            style="width: 1.7em; height: 1.2em; background-size: cover; background-image: url('https://cdn.jsdelivr.net/npm/flag-icons@6.7.0/flags/4x3/gb.svg');"></span>
                                        English
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <header class="site-header d-flex flex-column justify-content-center align-items-center">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-8 col-12 mb-5 text-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="/">{{ __('messages.home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                            </ol>
                        </nav>
                        <h2 class="text-white">@yield('header')</h2>
                    </div>
                </div>
            </div>
        </header>
        @yield('content')

        @include('layouts.footer')
    </main>

    <!-- JAVASCRIPT FILES -->
    <script src="{{ asset('src/js/jquery.min.js') }}"></script>
    <script src="{{ asset('src/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('src/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('src/js/custom.js') }}"></script>

</body>

</html>
