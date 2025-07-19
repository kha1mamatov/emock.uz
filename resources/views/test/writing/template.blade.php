<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('src/css/ielts.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>
    <div class="top-bar" style="display: flex; justify-content: space-between; align-items: center;">
        <div class="ielts-logo">IELTS</div>
        <div class="timer" id="timer">00:00</div>
        <div class="test-id">Test taker ID</div>
    </div>

    @yield('content')

    <div class="overlay" id="overlay">
        <h2>Thank you! Your response has been submitted.</h2>
        <a href="{{ route('dashboard.history') }}">Go to Dashboard</a>
    </div>

    @yield('scripts')
</body>

</html>
