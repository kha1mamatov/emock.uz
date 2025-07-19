<div class="table">
    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Date</th>
                <th>Score</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tests as $index=>$test)
                @php
                    $attempt = $test->latest_attempt;
                @endphp

                <tr>
                    <td class="text-muted">{{ $index + 1 }}</td>

                    <td>
                        <strong>{{ $test->title ?? 'Listening Test #' . $test->id }}</strong>
                        <div class="text-muted small">ID: {{ $test->id }}</div>
                    </td>

                    <td>
                        <span class="text-nowrap">{{ $test->created_at->format('d M Y') }}</span>
                    </td>

                    <td>
                        @if ($attempt && $attempt->score)
                            <span style="color: white !important;" class="badge bg-success">{{ $attempt->score }}</span>
                        @else
                            <span style="color: white !important;" class="badge bg-secondary">Not taken</span>
                        @endif
                    </td>

                    <td>
                        @if ($attempt)
                            @switch($attempt->status)
                                @case('completed')
                                    <span style="color: white !important;" class="badge bg-success">Completed</span>
                                @break

                                @case('pending')
                                    <span style="color: white !important;" class="badge bg-warning text-dark">Pending</span>
                                @break

                                @default
                                    <span style="color: white !important;" class="badge bg-secondary">{{ ucfirst($attempt->status) }}</span>
                            @endswitch
                        @else
                            <span style="color: white !important;" class="badge bg-info text-white">Available</span>
                        @endif
                    </td>

                    <td>
                        <div class="btn-group btn-group-sm" role="group">
                            @if ($attempt)
                                <a href="{{ route('dashboard.history.view', $attempt->id) }}" class="btn btn-outline-primary">
                                    <i class="bi bi-bar-chart"></i> View
                                </a>
                                <a href="{{ route('test.take', [
                                    'type' => 'one',
                                    'id' => $attempt->mock_test_id,
                                    'skill' => $attempt->skill,
                                ]) }}" class="btn btn-outline-success">
                                    Retake
                                </a>
                            @else
                                <a href="{{ route('test.take', [
                                    'type' => 'one',
                                    'id' => $test->id,
                                    'skill' => $test->skill,
                                ]) }}" class="btn btn-outline-success">
                                    Start
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
