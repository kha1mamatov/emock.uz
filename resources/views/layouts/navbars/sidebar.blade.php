<div class="sidebar d-flex flex-column" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="/dashboard" class="simple-text logo-normal">
            {{ __('eMock.uz') }}
        </a>
    </div>
    <div class="sidebar-wrapper flex-grow-1 d-flex flex-column justify-content-between">
        <ul class="nav flex-column">
            {{-- ⚙️ Admin --}}
            @if (auth()->user()->isAdmin())
                <li class="{{ $elementActive == 'admin-dashboard' ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="nc-icon nc-settings-gear-65"></i>
                        <p>Site Admin</p>
                    </a>
                </li>
            @endif

            {{-- 👩‍🏫 Teacher --}}
            {{-- @if (auth()->user()->isTeacher())
                <li class="{{ $elementActive == 'teacher-dashboard' ? 'active' : '' }}">
                    <a href="{{ route('teacher.dashboard') }}">
                        <i class="nc-icon nc-single-copy-04"></i>
                        <p>Teacher Dashboard</p>
                    </a>
                </li>
                <li class="{{ $elementActive == 'teacher-reviews' ? 'active' : '' }}">
                    <a href="{{ route('teacher.reviews.index') }}">
                        <i class="nc-icon nc-check-2"></i>
                        <p>Review Tasks</p>
                    </a>
                </li>
            @endif --}}

            @if (auth()->user()->isBoss())
                <li>
                    <a data-toggle="collapse" aria-expanded="false" href="#AdminTests">
                        <i class="nc-icon nc-paper"></i>
                        <p>
                            Manage Tests
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="AdminTests">
                        <ul class="nav">
                            <li class="{{ $elementActive == 'admin-writing' ? 'active' : '' }}">
                                <a href="{{ route('admin.tests.index', ['skill' => 'writing']) }}">
                                    <span class="sidebar-mini-icon">✍️</span>
                                    <span class="sidebar-normal">Writing Tests</span>
                                </a>
                            </li>
                            {{-- <li class="{{ $elementActive == 'admin-speaking' ? 'active' : '' }}">
                                <a href="{{ route('admin.tests.index', ['skill' => 'speaking']) }}">
                                    <span class="sidebar-mini-icon">🗣️</span>
                                    <span class="sidebar-normal">Speaking Tests</span>
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                </li>
            @endif

            {{-- 👤 User + Everyone --}}
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard.index') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="{{ $elementActive == 'history' ? 'active' : '' }}">
                <a href="{{ route('dashboard.history') }}">
                    <i class="fa fa-history"></i>
                    <p>{{ __('dashboard.history') }}</p>
                </a>
            </li>

            <li class="{{ $elementActive == 'leaderboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard.leaderboard') }}">
                    <i class="fa fa-trophy"></i>
                    <p>{{ __('dashboard.leaderboard') }}</p>
                </a>
            </li>

            <li>
                <a data-toggle="collapse" aria-expanded="true" href="#Practice">
                    <i class="nc-icon nc-laptop"></i>
                    <p>
                        Practice Tests
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="Practice">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'writing' ? 'active' : '' }}">
                            <a href="{{ route('dashboard.tests.writing') }}">
                                <span class="sidebar-mini-icon">✍️</span>
                                <span class="sidebar-normal">IELTS Writing</span>
                            </a>
                        </li>
                        {{-- <li class="{{ $elementActive == 'speaking' ? 'active' : '' }}">
                            <a href="{{ route('dashboard.tests.speaking') }}">
                                <span class="sidebar-mini-icon">🗣️</span>
                                <span class="sidebar-normal">IELTS Speaking</span>
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</div>
