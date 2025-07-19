<div class="wrapper">

    @include('layouts.navbars.sidebar')

    <div class="main-panel">
        @include('layouts.navbars.nav')
        @yield('content')
    </div>
</div>