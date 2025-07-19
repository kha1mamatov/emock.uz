@foreach ($tests as $index => $test)
    @php
        $attempt = $test->latest_attempt;
    @endphp

    <div class="col-lg-4 card shadow-sm border-0">
        <div class="card-body flex-column h-100 justify-content-between">

            {{-- Test Title & Date --}}
            <div class="mb-3">
                <h5 class="card-title mb-1">{{ $test->title ?? 'Listening Test #' . $test->id }}</h5>
                <p class="card-subtitle text-muted small">{{ $test->created_at->format('d M Y, H:i') }}</p>
            </div>

            {{-- Score --}}
            <div class="mb-2">
                <strong>Score:</strong>
                <span style="color: white !important;" class="badge bg-{{ $attempt && $attempt->score ? 'success' : 'secondary' }}">
                    {{ $attempt->score ?? '—' }}
                </span>
            </div>

            {{-- Status --}}
            @if (isset($attempt->score))
                <div class="mb-3">
                    <strong>Status:</strong>
                    @if ($attempt)
                        <span
                            class="badge 
                        @if ($attempt->status === 'completed') bg-success
                        @elseif($attempt->status === 'pending') bg-warning text-dark
                        @else bg-secondary @endif">
                            {{ ucfirst($attempt->status) }}
                        </span>
                    @else
                        <span class="badge bg-info" style="color: white !important;">Available</span>
                    @endif
                </div>
            @endif
            {{-- Action Buttons --}}
            <div class="mt-auto flex-column gap-2">
                @if ($attempt)
                    <a href="{{ route('dashboard.history.view', $attempt->id) }}" class="btn btn-sm btn-outline-primary w-100">
                        View Result
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
@endforeach
