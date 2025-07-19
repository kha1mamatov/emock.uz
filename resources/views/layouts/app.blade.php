<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="{{ asset('src/icons/logo/emock-logo-no-bg-32.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('src/icons/apple/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('src/icons/favicon-circled-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('src/icons/favicon-circled-16.png') }}">

    <title>
        {{ __('Dashboard - eMock.uz') }}
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('src/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('src/css/dashboard.css') }}" rel="stylesheet" />
    <link href="{{ asset('src/css/dashboard-dark.css') }}" rel="stylesheet">
    <script src="https://twemoji.maxcdn.com/v/latest/twemoji.min.js" crossorigin="anonymous"></script>

    @stack('styles')
</head>

<body class="{{ $class }}">

    @auth()
        @include('layouts.user')
    @endauth

    <!--   Core JS Files   -->
    <script src="{{ asset('src/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('src/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('src/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('src/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <!-- Chart JS -->
    <script src="{{ asset('src/js/plugins/chartjs.min.js') }}"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('src/js/plugins/bootstrap-notify.js') }}"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('src/js/dashboard.min.js') }}" type="text/javascript"></script>
    <script>
        function setTheme(theme) {
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
        }

        function getSystemTheme() {
            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        }

        document.addEventListener('DOMContentLoaded', () => {
            const saved = localStorage.getItem('theme');
            setTheme(saved || getSystemTheme());
        });
        document.addEventListener("DOMContentLoaded", function() {
            twemoji.parse(document.body, {
                folder: "svg",
                ext: ".svg"
            });
        });
    </script>

    @stack('scripts')

    @include('layouts.navbars.fixed-plugin-js')
</body>

</html>
