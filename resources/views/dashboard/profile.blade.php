@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'profile',
])


@section('content')
    <div class="content">
        <div class="row">
            <!-- Left: User Info -->
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="image">
                        <img src="{{ asset('src/img/bg5.jpg') }}" alt="Background">
                    </div>
                    <div class="card-body">
                        <div class="author text-center">
                            <img class="avatar border-gray"
                                src="{{ auth()->user()->avatar ?? asset('src/img/default-avatar.png') }}" alt="Avatar">
                            <h5 class="title mt-2">{{ auth()->user()->name }}</h5>
                            <p class="description">{{ auth()->user()->email }}</p>
                            <p class="description text-muted">{{ __('dashboard.joined') }}: {{ auth()->user()?->created_at?->format('d M Y') ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="text-center">
                            <a href="{{ route('logout') }}" class="btn btn-danger btn-round">{{ __('dashboard.logout') }}</a>
                        </div>
                    </div>
                </div>

                @if (auth()->id() === $user->id && $logins->isNotEmpty())
                    <h5 class="mt-4">{{ __('dashboard.login_history') }}</h5>
                    <ul class="list-group">
                        @foreach ($logins as $log)
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ $log->created_at->format('d M Y, H:i') }}</span>
                                <span>{{ $log->ip_address }} | {{ $log->user_agent }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>


            <!-- Right: Personal Records -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">{{ __('dashboard.personal_records') }}</h5>
                        <p class="category text-muted">{{ __('dashboard.your_performance_summary') }}</p>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-4">
                                <h6 class="text-uppercase text-muted">{{ __('dashboard.highest_overall_score') }}</h6>
                                <h3 class="text-info">{{ $highestScore ?? 'N/A' }}</h3>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-uppercase text-muted">{{ __('dashboard.most_practiced_skill') }}</h6>
                                <h3 class="text-success">{{ ucfirst($topSkill ?? 'N/A') }}</h3>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-uppercase text-muted">{{ __('dashboard.total_tests') }}</h6>
                                <h3 class="text-primary">{{ $totalTests }}</h3>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-md-12">
                                <canvas id="recordChart" height="155"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection

@push('scripts')
    <script>
        const skillCtx = document.getElementById('recordChart').getContext('2d');
        new Chart(skillCtx, {
            type: 'bar',
            data: {
                labels: ['Listening', 'Reading', 'Writing', 'Speaking'],
                datasets: [{
                    label: 'Average Band',
                    data: @json($skillAverages),
                    backgroundColor: 'rgba(153, 102, 255, 0.6)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMin: 4,
                        suggestedMax: 9,
                        ticks: {
                            stepSize: 0.5
                        }
                    }
                }
            }
        });
    </script>
@endpush
