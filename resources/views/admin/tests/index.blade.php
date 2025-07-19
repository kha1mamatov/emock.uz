@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'admin-writing',
])

@section('content')
    <div class="content">
        <div class="row mb-3">
            <div class="col-md-8">
                <h4 class="card-title">Writing Tests</h4>
                <p class="card-category text-muted">All uploaded Writing tests</p>
            </div>
            <div class="col-md-4 d-flex justify-content-end align-items-center">
                <a href="{{ route('admin.tests.create', ['skill' => 'writing']) }}" class="btn btn-primary">
                    <i class="nc-icon nc-simple-add"></i> Upload Test
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Test List</h5>
            </div>
            <div class="card-body table">
                <table class="table align-items-center">
                    <thead class="text-primary">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Skill</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tests as $test)
                            <tr>
                                <td>{{ $test->id }}</td>
                                <td>{{ $test->title }}</td>
                                <td>{{ ucfirst($test->skill) }}</td>
                                <td>{{ $test->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm gap-1" role="group">
                                        <a href="{{ route('admin.tests.edit', ['skill' => $test->skill, 'test' => $test->id]) }}"
                                           class="btn btn-outline-info" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <form method="POST"
                                              action="{{ route('admin.tests.destroy', ['skill' => $test->skill, 'test' => $test->id]) }}"
                                              onsubmit="return confirm('Are you sure you want to delete this test?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger" title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No tests found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
