@extends('layouts.app')

@section('content')
<div class="content">
    <h4>{{ $test->title }}</h4>

    @if ($skill === 'writing')
        <p><strong>Task Type:</strong> {{ strtoupper($test->task_type) }}</p>
        <p><strong>Prompt:</strong> {{ $test->prompt }}</p>
        @if ($test->media)
            <img src="{{ asset('storage/' . $test->media) }}" class="img-fluid mt-3" />
        @endif
    @elseif ($skill === 'speaking')
        @php $data = json_decode($test->json, true); @endphp
        <h5>Part 1</h5>
        <ul>@foreach ($data['part_1'] ?? [] as $q)<li>{{ $q }}</li>@endforeach</ul>
        <h5>Part 2</h5>
        <p><strong>{{ $data['part_2']['prompt'] ?? '' }}</strong></p>
        <ul>@foreach ($data['part_2']['notes'] ?? [] as $note)<li>{{ $note }}</li>@endforeach</ul>
        <h5>Part 3</h5>
        <ul>@foreach ($data['part_3'] ?? [] as $q)<li>{{ $q }}</li>@endforeach</ul>
    @endif
</div>
@endsection
