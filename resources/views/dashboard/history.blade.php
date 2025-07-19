@extends('layouts.app', ['class' => '', 'elementActive' => 'history'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <h4 class="mb-4 fw-bold">
                Your Test History
            </h4>

            {{-- Writing Results --}}
            <h5 class="mt-4 mb-2 fw-semibold text-warning">
                <i class="nc-icon nc-paper text-warning"></i> Writing Tests
            </h5>
            <div class="table mb-4 shadow-sm border rounded p-2">
                <table class="table table align-middle">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Task Type</th>
                            <th>Band</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($oneSkills['writing'] ?? [] as $i => $test)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $test->created_at->format('d M Y, H:i') }}</td>
                                <td>{{ ucfirst(str_replace('_', ' ', $test->task_type ?? '—')) }}</td>
                                <td><strong>{{ $test->band_score }}</strong></td>
                                <td>
                                    <span class="badge bg-{{ $test->status == 'completed' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($test->status) }}
                                    </span>
                                </td>
                                <td><a href="{{ route('dashboard.history.view', $test->id) }}" class="btn btn-sm btn-outline-info">View</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">No writing results found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Speaking Results --}}
            {{-- <h5 class="mt-4 mb-2 fw-semibold text-danger">
                <i class="nc-icon nc-chat-33 text-danger"></i> Speaking Tests
            </h5>
            <div class="table mb-4 shadow-sm border rounded p-2">
                <table class="table table align-middle">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Raw</th>
                            <th>Band</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($oneSkills['speaking'] ?? [] as $i => $test)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $test->created_at->format('d M Y, H:i') }}</td>
                                <td>{{ $test->raw_score ?? '—' }}</td>
                                <td><strong>{{ $test->band_score }}</strong></td>
                                <td>
                                    <span class="badge bg-{{ $test->status == 'completed' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($test->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                                        data-bs-target="#reviewModal-{{ $test->id }}">
                                        View
                                    </a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="reviewModal-{{ $test->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Teacher Feedback</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Band:</strong> {{ $test->marking_band ?? '—' }}</p>
                                                    <p><strong>Comment:</strong><br>{{ $test->teacher_comment ?? 'No feedback yet.' }}
                                                    </p>
                                                    @if ($test->reviewed_by)
                                                        <small class="text-muted">Reviewed by:
                                                            {{ $test->reviewer->name }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No speaking results found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div> --}}
        </div>
    </div>
@endsection
