<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-toggle">
                <button type="button" class="navbar-toggler">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <a class="navbar-brand" href="#pablo">Dashboard</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
            aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            {{-- <form>
                <div class="input-group no-border">
                    <input type="text" value="" class="form-control" placeholder="Search...">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="nc-icon nc-zoom-split"></i>
                        </div>
                    </div>
                </div>
            </form> --}}
            <ul class="navbar-nav">
                <li class="nav-item btn-rotate dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="themeDropdown" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="nc-icon nc-bulb-63"></i>
                        <p class="d-lg-none d-md-block">Theme</p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="themeDropdown">
                        <a class="dropdown-item" href="javascript:void(0);" onclick="setTheme('light')">
                            🌞 {{ __('dashboard.light_theme') }}
                        </a>
                        <a class="dropdown-item" href="javascript:void(0);" onclick="setTheme('dark')">
                            🌙 {{ __('dashboard.dark_theme') }}
                        </a>
                        <a class="dropdown-item" href="javascript:void(0);" onclick="setTheme(getSystemTheme())">
                            🖥 {{ __('dashboard.system_theme') }}
                        </a>
                    </div>
                </li>


                <!-- Language Dropdown Styled Like Notifications -->
                <li class="nav-item btn-rotate dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="nc-icon nc-world-2"></i>
                        <p><span class="d-lg-none d-md-block">Language</span></p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="languageDropdown">
                        <a class="dropdown-item d-flex align-items-center gap-2"
                            href="{{ route('lang.switch', ['lang' => 'uz']) }}">
                            <span class="fi fi-uz"
                                style="width: 1.5em; height: 1em; background-size: cover;
                                         background-image: url('https://cdn.jsdelivr.net/npm/flag-icons@6.7.0/flags/4x3/uz.svg');">
                            </span>
                            O'zbek
                        </a>
                        <a class="dropdown-item d-flex align-items-center gap-2"
                            href="{{ route('lang.switch', ['lang' => 'ru']) }}">
                            <span class="fi fi-ru"
                                style="width: 1.5em; height: 1em; background-size: cover;
                                         background-image: url('https://cdn.jsdelivr.net/npm/flag-icons@6.7.0/flags/4x3/ru.svg');">
                            </span>
                            Русский
                        </a>
                        <a class="dropdown-item d-flex align-items-center gap-2"
                            href="{{ route('lang.switch', ['lang' => 'en']) }}">
                            <span class="fi fi-gb"
                                style="width: 1.5em; height: 1em; background-size: cover;
                                         background-image: url('https://cdn.jsdelivr.net/npm/flag-icons@6.7.0/flags/4x3/gb.svg');">
                            </span>
                            English
                        </a>
                    </div>
                </li>

                <li class="nav-item btn-rotate dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="nc-icon nc-bell-55"></i>
                        <p>
                            <span class="d-lg-none d-md-block">{{ __('dashboard.notifications') }}</span>
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        @if (auth()->user()->unreadNotifications->isEmpty())
                            <div class="dropdown-item text-muted">
                                {{ __('dashboard.no_notifications') }}
                            </div>
                        @else
                            @foreach (auth()->user()->unreadNotifications as $note)
                                <div class="dropdown-item d-flex justify-content-between align-items-center">
                                    <div>
                                        {{ $note->data['message'] ?? 'New notification' }}
                                        — <a href="{{ route('dashboard.history') }}">View</a>
                                    </div>
                                    <form method="POST" action="{{ route('notifications.read', $note->id) }}"
                                        class="d-inline">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">Mark as
                                            Read</button>
                                    </form>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </li>
                <li class="nav-item btn-rotate dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="nc-icon nc-settings-gear-65"></i>
                        <p>
                            <span class="d-lg-none d-md-block">{{ __('dashboard.account') }}</span>
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink2">
                        <form class="dropdown-item" action="{{ route('logout') }}" id="formLogOut" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item"
                                onclick="document.getElementById('formLogOut').submit();">{{ __('dashboard.logout') }}</a>
                            <a class="dropdown-item" href="{{ route('profile') }}">{{ __('dashboard.profile') }}</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
