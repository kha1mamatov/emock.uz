@extends('layouts.app', ['class' => '', 'elementActive' => 'leaderboard'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <h4 class="mb-4 fw-bold text-success">
            Top Performers Leaderboard
        </h4>

        <div class="table shadow-sm border rounded p-3">
            <table class="table table table-striped align-middle">
                <thead class="thead-light">
                    <tr>
                        <th>Rank</th>
                        <th>Name</th>
                        <th>Tests Taken</th>
                        <th>Average Band</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $user)
                        <tr>
                            <td><strong>#{{ $index + 1 }}</strong></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->total_tests }}</td>
                            <td><strong>{{ number_format($user->average_score, 1) }}</strong></td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted">No users found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
