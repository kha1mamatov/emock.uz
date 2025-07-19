@extends('layouts.app', ['class' => '', 'elementActive' => 'admin-dashboard'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <h3 class="mb-4 fw-bold">📊 Admin Dashboard</h3>

            <div class="row">
                <x-stat-box title="Total Tests" value="{{ $totalTests }}" icon="nc-paper" color="info" />
                <x-stat-box title="Completed Tests" value="{{ $completedTests }}" icon="nc-check-2" color="success" />
                <x-stat-box title="Users Active" value="{{ $activeUsers }}" icon="nc-single-02" color="primary" />
                <x-stat-box title="Total Users" value="{{ $totalUsers }}" icon="nc-circle-10" color="secondary" />
            </div>

            <div class="card mt-5">
                <div class="card-header">
                    <h5 class="card-title">Monthly Tests Overview (Last 6 Months)</h5>
                </div>
                <div class="card-body">
                    <canvas id="monthlyChart" height="90"></canvas>
                </div>
            </div>

            <div class="row mt-4">
                <!-- Bar Chart: Skill Breakdown -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>🧪 Tests by Skill</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="skillChart" height="100"></canvas>
                        </div>
                    </div>
                </div>

                <!-- (Optional Placeholder) Another chart can go here if needed -->
                <div class="col-md-6">
                    <div class="card text-center d-flex align-items-center justify-content-center" style="height: 100%;">
                        <div class="card-body">
                            <h6 class="text-muted">No other metrics being tracked</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Line chart: Monthly overview
        const ctx = document.getElementById('monthlyChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($monthlyLabels),
                datasets: [{
                    label: 'Tests Taken',
                    data: @json($monthlyData),
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    borderColor: '#007bff',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true,
                    pointRadius: 5,
                    pointBackgroundColor: '#007bff'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
@endpush
