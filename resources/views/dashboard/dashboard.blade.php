@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'dashboard',
])

@section('content')
<div class="content">
    {{-- Top Stats --}}
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <x-dashboard.stat-card icon="nc-paper" color="info" title="Total Tests"
                        value="{{ $totalTests }}" footer="All Time" footerIcon="fa-calendar" />
                </div>

                <div class="col-md-6">
                    <x-dashboard.stat-card icon="nc-refresh-69" color="warning" title="Progress"
                        value="{{ $scoreChange > 0 ? '+' . $scoreChange : $scoreChange ?? '0.0' }}"
                        footer="Since First Test" footerIcon="fa-arrow-up" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <x-dashboard.stat-card icon="nc-time-alarm" color="primary" title="Latest Score"
                        value="{{ $latestScore ?? 'N/A' }}" footer="Most Recent Test" footerIcon="fa-clock-o" />
                </div>
                <div class="col-md-6">
                    <x-dashboard.stat-card icon="nc-chart-bar-32" color="success" title="Average Band"
                        value="{{ $averageScore }}" footer="Based on Completed Tests" footerIcon="fa-star" />
                </div>
            </div>
        </div>

        {{-- Personal Records --}}
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="card-title mb-1">
                        <i class="nc-icon nc-trophy text-warning mr-1"></i> Personal Records
                    </h5>
                    <p class="card-category mb-0 text-muted">Highest Scores Per Skill</p>
                </div>
                <div class="card-body mt-1 mb-2">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="d-flex align-items-center">
                                <i class="nc-icon nc-star-2 text-info mr-2"></i>
                                <strong>Highest Overall Score</strong>
                            </div>
                            <div class="text-right">
                                {{ $personalRecords['highest_overall'] ?? 'N/A' }}
                            </div>
                        </li>
                        @foreach (['writing', 'speaking'] as $skill)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="nc-icon {{ [
                                        'writing' => 'nc-paper text-warning',
                                        'speaking' => 'nc-chat-33 text-danger',
                                    ][$skill] }} mr-2">&nbsp;&nbsp;</i>
                                    <strong>{{ ucfirst($skill) }}</strong>
                                </div>
                                <span>{{ $personalRecords[$skill] ?? '—' }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- Score Chart --}}
    <x-dashboard.chart-card title="Score Progress" icon="nc-delivery-fast text-primary"
        subtitle="Performance (Last 6 Tests)" canvasId="scoreChart" />

    {{-- Writing & Speaking Charts --}}
    <div class="row mt-4">
        <x-dashboard.chart-card col="6" title="Writing Task Distribution"
            icon="nc-ruler-pencil text-danger" subtitle="Task 1 vs Task 2" canvasId="writingChart" />
        <x-dashboard.chart-card col="6" title="Speaking Activity"
            icon="nc-chat-33 text-primary" subtitle="Total Speaking Attempts" canvasId="speakingChart" />
    </div>

    {{-- Activity Chart --}}
    <div class="row mt-4">
        <x-dashboard.chart-card col="12" title="Test Activity"
            icon="nc-bulb-63 text-warning" subtitle="Tests Over Last 6 Months" canvasId="activityChart" />
    </div>
    {{-- Recent Test Table --}}
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="nc-icon nc-bullet-list-67 text-primary"></i> Recent Mock Tests
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="text-primary">
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Band</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentTests as $test)
                                <tr>
                                    <td>{{ $test->created_at->format('d M Y') }}</td>
                                    <td>
                                        <span class="badge badge-info" style="color: white !important;">
                                            {{ ucfirst($test->skill) }}
                                        </span>
                                    </td>
                                    <td>{{ $test->band_score ?? '—' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No tests found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    // Score Chart
    new Chart(document.getElementById('scoreChart'), {
        type: 'line',
        data: {
            labels: @json($scoreMonths),
            datasets: [{
                label: 'IELTS Score',
                data: @json($scoreValues),
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    suggestedMin: 4,
                    suggestedMax: 9,
                    ticks: { stepSize: 0.5 }
                }
            }
        }
    });

    // Writing Pie
    new Chart(document.getElementById('writingChart'), {
        type: 'pie',
        data: {
            labels: @json($writingTypes),
            datasets: [{
                data: @json($writingCounts),
                backgroundColor: ['rgba(54, 162, 235, 0.7)', 'rgba(255, 99, 132, 0.7)'],
                borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
                borderWidth: 1
            }]
        },
        options: { responsive: true }
    });

    // Speaking Bar
    new Chart(document.getElementById('speakingChart'), {
        type: 'bar',
        data: {
            labels: ['Speaking'],
            datasets: [{
                label: 'Attempts',
                data: [{{ $totalSpeakingTests ?? 0 }}],
                backgroundColor: 'rgba(255, 206, 86, 0.7)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });

    // Activity Chart
    new Chart(document.getElementById('activityChart'), {
        type: 'bar',
        data: {
            labels: @json($activityLabels),
            datasets: [{
                label: 'Tests Taken',
                data: @json($activityCounts),
                backgroundColor: 'rgba(255, 159, 64, 0.6)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: ctx => `${ctx.parsed.y} test(s)`
                    }
                },
                legend: { display: false }
            }
        }
    });
</script>
@endpush
