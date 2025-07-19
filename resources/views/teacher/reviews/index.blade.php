@extends('layouts.app', ['class' => '', 'elementActive' => 'teacher-reviews'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <h4 class="mb-4">
            📝 Tasks Awaiting Review
        </h4>

        @if ($results->isEmpty())
            <div class="alert alert-info text-center">No writing or speaking submissions awaiting review.</div>
        @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Skill</th>
                            <th>Submitted At</th>
                            <th>Band</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $i => $result)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $result->user->name }}</td>
                                <td class="text-capitalize">{{ $result->skill }}</td>
                                <td>{{ $result->created_at->format('d M Y, H:i') }}</td>
                                <td>
                                    @if ($result->band_score)
                                        <strong>{{ $result->band_score }}</strong>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('teacher.reviews.show', $result->id) }}" class="btn btn-sm btn-primary">
                                        Review
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
