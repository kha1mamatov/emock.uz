@extends('layouts.app', ['class' => '', 'elementActive' => 'teacher-dashboard'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <h4 class="mb-4 fw-bold text-info">👩‍🏫 Welcome, Teacher</h4>

            <div class="row">
                <x-dashboard.stat-box title="Total Reviews" value="{{ $totalReviewed }}" icon="fa fa-check" color="info" />
                <x-dashboard.stat-box title="Pending Tasks" value="{{ $pending }}" icon="fa fa-clock" color="warning" />
                <x-dashboard.stat-box title="Reviewed Today" value="{{ $reviewedToday }}" icon="fa fa-check-circle" color="success" />
            </div>

            <div class="row mt-4">
                <!-- Skill Bar Chart -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>🧪 Reviewed by Skill</h5>
                        </div>
                        <div class="card-body"><canvas id="skillChart" height="100"></canvas></div>
                    </div>
                </div>

                <!-- Activity Line Chart -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>📅 Review Activity (Last 30 Days)</h5>
                        </div>
                        <div class="card-body"><canvas id="activityChart" height="100"></canvas></div>
                    </div>
                </div>
            </div>

            <!-- Recent Reviews Table -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5>📋 Recent Reviews</h5>
                </div>
                <div class="card-body table">
                    <table class="table table">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Skill</th>
                                <th>Test</th>
                                <th>Band</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentReviews as $r)
                                <tr>
                                    <td>{{ $r->user->name }}</td>
                                    <td>{{ ucfirst($r->skill) }}</td>
                                    <td>{{ $r->test->title ?? '—' }}</td>
                                    <td>{{ $r->band_score }}</td>
                                    <td>{{ $r->updated_at->format('M d, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No reviews found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Quick Review Access -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5>⏳ Pending Reviews</h5>
                </div>
                <div class="card-body table">
                    <table class="table table">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Skill</th>
                                <th>Test</th>
                                <th>Submitted</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pendingReviews as $review)
                                <tr>
                                    <td>{{ $review->user->name }}</td>
                                    <td>{{ ucfirst($review->skill) }}</td>
                                    <td>{{ $review->test->title ?? '—' }}</td>
                                    <td>{{ $review->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('teacher.reviews.show', $review->id) }}"
                                            class="btn btn-sm btn-info">
                                            ✏️ Review
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No pending reviews.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        new Chart(document.getElementById('skillChart'), {
            type: 'bar',
            data: {
                labels: @json($skillLabels),
                datasets: [{
                    label: 'Reviewed',
                    data: @json($skillData),
                    backgroundColor: ['#00c0ef', '#f39c12']
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(document.getElementById('activityChart'), {
            type: 'line',
            data: {
                labels: @json($activityLabels),
                datasets: [{
                    label: 'Reviews',
                    data: @json($activityData),
                    fill: true,
                    tension: 0.3,
                    backgroundColor: 'rgba(0,192,239,0.1)',
                    borderColor: '#00c0ef'
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
