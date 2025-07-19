<!-- Enhanced Writing Practice Page with Filters, View Switcher, and Stylish Appearance -->
@extends('layouts.app', ['class' => '', 'elementActive' => 'writing'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <h4 class="mb-4 fw-bold text-info">
                <i class="nc-icon nc-headphones text-info"></i> Writing Practice Tests
            </h4>

            <!-- Filters & View Controls -->
            <form method="GET" id="filter-form">
                <div class="d-flex align-items-center row mb-4">
                    <div class="col-lg-4">
                        <select name="sort" class="form-select shadow-sm border-info" onchange="this.form.submit()">
                            <option class="dropdown-item" value="recent"
                                {{ request('sort') == 'recent' ? 'selected' : '' }}>
                                Newest</option>
                            <option class="dropdown-item" value="oldest"
                                {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                                Oldest</option>
                            <option class="dropdown-item" value="highest"
                                {{ request('sort') == 'highest' ? 'selected' : '' }}>
                                Highest Score
                            </option>
                            <option class="dropdown-item" value="lowest"
                                {{ request('sort') == 'lowest' ? 'selected' : '' }}>
                                Lowest Score
                            </option>
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <select name="status" class="form-select shadow-sm border-info" onchange="this.form.submit()">
                            <option class="dropdown-item" value="">All Statuses</option>
                            <option class="dropdown-item" value="completed"
                                {{ request('status') == 'completed' ? 'selected' : '' }}>Completed
                            </option>
                            <option class="dropdown-item" value="pending"
                                {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                            </option>
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <div class="btn-group w-100 justify-content-end" role="group">
                            <button class="btn btn-outline-info" onclick="setView('table')" title="Table View">
                                <i class="nc-icon nc-bullet-list-67"></i>
                            </button>
                            <button class="btn btn-outline-info" onclick="setView('cards')" title="Card View">
                                <i class="nc-icon nc-paper"></i>
                            </button>
                            <button class="btn btn-outline-info" onclick="setView('gallery')" title="Gallery View">
                                <i class="nc-icon nc-album-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            @if ($tests->isEmpty())
                <div id="empty-message" class="alert alert-info text-center mt-4">
                    No Writing tests found.
                </div>
            @else
                <div id="test-view-mode">
                    <div id="table-view">
                        @include('dashboard.tests.partials.table', ['tests' => $tests])
                    </div>
                    <div id="card-view" style="display:none;">
                        @include('dashboard.tests.partials.cards', ['tests' => $tests])
                    </div>
                    <div id="gallery-view" style="display:none;">
                        @include('dashboard.tests.partials.gallery', ['tests' => $tests])
                    </div>
                </div>
            @endif


            <div class="d-flex justify-content-center mt-4">
                {{ $tests->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const mode = localStorage.getItem('test_view_mode') || 'table';
            setView(mode);
        });

        function setView(view) {
            localStorage.setItem('test_view_mode', view);

            document.getElementById('table-view')?.style.setProperty('display', view === 'table' ? 'block' : 'none');
            document.getElementById('card-view')?.style.setProperty('display', view === 'cards' ? 'flex' : 'none');
            document.getElementById('gallery-view')?.style.setProperty('display', view === 'gallery' ? 'block' : 'none');

            document.querySelectorAll('.btn-group .btn').forEach(btn => btn.classList.remove('active'));
            const activeBtn = document.querySelector(`.btn-group .btn[onclick*="'${view}'"]`);
            activeBtn?.classList.add('active');
        }
    </script>
@endpush
