@foreach ($tests as $index => $test)
    @php
        $attempt = $test->latest_attempt;
    @endphp

    <div class="col">
        <div class="card h-100 shadow-sm border-0 text-center">
            <div class="card-body d-flex flex-column justify-content-between">

                {{-- Thumbnail and Title --}}
                <div class="mb-3">
                    <h6 class="card-title mb-1">{{ $test->title ?? 'Listening Test #' . $test->id }}</h6>
                    <p class="text-muted small">{{ $test->created_at->format('d M Y') }}</p>
                </div>

                {{-- Score --}}
                <div class="mb-2">
                    <span style="color: white !important;" class="badge bg-{{ $attempt && $attempt->score ? 'info' : 'secondary' }}">
                        Score: {{ $attempt->score ?? '—' }}
                    </span>
                </div>
                @if (isset($attempt->score))
                    {{-- Status --}}
                    <div class="mb-3">
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
                            <span style="color: white !important;" class="badge bg-info" style="color: white !important;">Available</span>
                        @endif
                    </div>
                @endif
                {{-- Actions --}}
                <div class="btn-group btn-group-sm mt-auto" role="group">
                    @if ($attempt)
                        <a href="{{ route('dashboard.history.view', $attempt->id) }}" class="btn btn-outline-primary">
                            <i class="bi bi-bar-chart"></i> View
                        </a>
                        <a href="{{ route('test.take', [
                            'type' => 'one',
                            'id' => $attempt->mock_test_id,
                            'skill' => $attempt->skill,
                        ]) }}"
                            class="btn btn-sm btn-outline-success">Retake Test
                        </a>
                    @else
                        <a href="{{ route('test.take', [
                            'type' => 'one',
                            'id' => $test->id,
                            'skill' => $test->skill,
                        ]) }}"
                            class="btn btn-sm btn-outline-success">Start
                        </a>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endforeach
