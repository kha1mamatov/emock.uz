@extends('layouts.app', ['class' => '', 'elementActive' => 'teacher-reviews'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <h4 class="mb-3">
            ✍️ Reviewing {{ ucfirst($result->skill) }} Submission
        </h4>

        <div class="card">
            <div class="card-body">
                <h6><strong>User:</strong> {{ $result->user->name }}</h6>
                <h6><strong>Submitted At:</strong> {{ $result->created_at->format('d M Y, H:i') }}</h6>
                <h6><strong>Status:</strong> 
                    @if($result->band_score)
                        <span class="badge bg-success">Reviewed</span>
                    @else
                        <span class="badge bg-warning text-dark">Pending</span>
                    @endif
                </h6>

                <hr>

                @if($result->skill === 'writing')
                    <div class="mb-3">
                        <h6><strong>Student's Writing:</strong></h6>
                        <div class="border p-3 rounded bg-light">{{ $result->writingAnswer->answer ?? '—' }}</div>
                    </div>
                @elseif($result->skill === 'speaking')
                    <div class="mb-3">
                        <h6><strong>Student's Audio:</strong></h6>
                        @if($result->speaking_audio_path)
                            <audio controls src="{{ asset('storage/' . $result->speaking_audio_path) }}"></audio>
                        @else
                            <p>No audio available.</p>
                        @endif
                    </div>
                @endif

                <hr>

                <form method="POST" action="{{ route('teacher.reviews.update', $result->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="band_score">Band Score</label>
                        <input type="number" step="0.1" min="0" max="9" name="band_score" class="form-control"
                            value="{{ old('band_score', $result->band_score) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="feedback">Teacher Feedback</label>
                        <textarea name="feedback" class="form-control" rows="5" placeholder="Enter comments or feedback">{{ old('feedback', $result->feedback) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">
                        ✅ Save Review
                    </button>
                    <a href="{{ route('teacher.reviews.index') }}" class="btn btn-secondary">
                        ← Back
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
