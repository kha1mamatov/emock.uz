@php
    use App\Enums\WritingType;
    $allCategories = [
        'Education',
        'Technology',
        'Environment',
        'Health',
        'Transport',
        'Communication',
        'Society',
        'Other',
    ];
    $selected = old('categories', $test->categories ?? []);
@endphp

@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'admin-writing',
])

@section('content')
    <div class="content">
        <div class="row mb-3">
            <div class="col-md-8">
                <h4 class="card-title">Edit Mock Test</h4>
                <p class="card-category text-muted">Modify the test details</p>
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-end">
                <a href="{{ route('admin.tests.index',  ['skill' => 'writing']) }}" class="btn btn-secondary">
                    <i class="nc-icon nc-minimal-left"></i> Back to List
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.tests.update', ['test' => $test]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Test Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $test->title) }}"
                            required>
                    </div>

                    {{-- Writing --}}
                        <input type="hidden" name="skill" value="writing">
                        <input type="hidden" name="task_type" value="{{ $test->task_type }}">

                        <div class="form-group">
                            <label>Prompt</label>
                            <textarea name="prompt" class="form-control" rows="10">{{ old('prompt', $test->prompt) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Model answer 8+</label>
                            <textarea name="model_answer" class="form-control" rows="10" placeholder="Enter writing model answer">{{ old('model_answer', $test->model_answer) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Writing Type</label>
                            <select name="writing_type" class="form-control">
                                <option value="">-- Select Type --</option>
                                @foreach (WritingType::all() as $type)
                                    <option value="{{ $type }}"
                                        {{ old('writing_type', $test->writing_type) === $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Categories</label>
                            <select name="categories[]" id="categories" class="form-control" multiple>
                                @foreach ($allCategories as $cat)
                                    <option value="{{ $cat }}" {{ in_array($cat, $selected) ? 'selected' : '' }}>
                                        {{ $cat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        @if ($test->task_type === '1')
                            <div class="form-group">
                                <label>Media (image)</label>
                                <div id="drop-area" class="border border-dashed rounded p-3 text-center bg-light"
                                    style="cursor: pointer;">
                                    <p id="drop-text" class="text-muted">Click, drag or paste an image</p>
                                    <input type="file" name="media" id="media-input" class="d-none" accept="image/*">
                                    <img id="media-preview"
                                        src="{{ isset($test) && $test->media ? asset('storage/' . $test->media) : '' }}"
                                        class="img-fluid mt-2 {{ isset($test) && $test->media ? '' : 'd-none' }}"
                                        style="max-height: 200px;">
                                </div>
                            </div>
                        @endif

                    {{-- Speaking --}}
                    {{-- @if ($skill === 'speaking')
                        <input type="hidden" name="skill" value="speaking">

                        <div class="form-group">
                            <label>Part 1 Questions</label>
                            <textarea name="speaking[part_1]" class="form-control" rows="3">{{ old('speaking.part_1', implode("\n", $speaking['part_1'] ?? [])) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Part 2 Prompt</label>
                            <input type="text" name="speaking[part_2][prompt]" class="form-control"
                                value="{{ old('speaking.part_2.prompt', $speaking['part_2']['prompt'] ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label>Part 2 Notes</label>
                            <textarea name="speaking[part_2][notes]" class="form-control" rows="2">{{ old('speaking.part_2.notes', implode("\n", $speaking['part_2']['notes'] ?? [])) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Part 3 Questions</label>
                            <textarea name="speaking[part_3]" class="form-control" rows="3">{{ old('speaking.part_3', implode("\n", $speaking['part_3'] ?? [])) }}</textarea>
                        </div>
                    @endif --}}

                    <button type="submit" class="btn btn-primary">
                        <i class="nc-icon nc-refresh-02"></i> Update Test
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        .select2-container--default .select2-selection--multiple {
            background-color: #1f222c !important;
            color: #fff !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: #fff !important;
        }

        .select2-dropdown {
            background-color: #1f222c !important;
            color: #fff !important;
        }

        .select2-search__field {
            color: #fff !important;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <script>
        const dropArea = document.getElementById('drop-area');
        const input = document.getElementById('media-input');
        const preview = document.getElementById('media-preview');

        // Open file dialog on click
        dropArea.addEventListener('click', () => input.click());

        // Handle file input change
        input.addEventListener('change', () => {
            const file = input.files[0];
            if (file) showImage(file);
        });

        // Handle drag over
        dropArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropArea.classList.add('bg-secondary', 'text-white');
        });

        // Handle drag leave
        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('bg-secondary', 'text-white');
        });

        // Handle drop
        dropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dropArea.classList.remove('bg-secondary', 'text-white');
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                const dt = new DataTransfer();
                dt.items.add(file);
                input.files = dt.files;
                showImage(file);
            }
        });

        // Handle paste
        window.addEventListener('paste', (e) => {
            const items = (e.clipboardData || e.originalEvent.clipboardData).items;
            for (let i = 0; i < items.length; i++) {
                const item = items[i];
                if (item.type.indexOf("image") === 0) {
                    const file = item.getAsFile();
                    const dt = new DataTransfer();
                    dt.items.add(file);
                    input.files = dt.files;
                    showImage(file);
                    break;
                }
            }
        });

        // Preview image
        function showImage(file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#categories').select2({
                tags: true,
                placeholder: "Select or add categories",
                width: '100%'
            });
        });
    </script>
    <script>
        document.getElementById('media-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('media-preview');
            const wrapper = document.getElementById('preview-wrapper');

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    wrapper.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                wrapper.style.display = 'none';
            }
        });
    </script>
@endpush
