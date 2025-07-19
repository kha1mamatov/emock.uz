@extends('layouts.app', ['class' => '', 'elementActive' => 'history'])

@section('title', 'Writing Task Result')

@section('content')
    <div class="content">
        <div class="container py-4">
            <h3 class="mb-4 text-info">Writing Task Result</h3>

            <div class="card mb-3">
                <div class="card-header">
                    <strong>Task {{ $result->task_type === 'task_2' ? '2' : '1' }}</strong>
                </div>
                <div class="card-body">
                    <p><strong>Word Count:</strong> {{ $result->writingAnswer->word_count }}</p>
                    <p><strong>Submitted on:</strong> {{ $result->created_at->format('Y-m-d H:i') }}</p>
                    <hr>
                    <p><strong>Your Response:</strong></p>
                    <div class="p-3 border rounded" style="white-space: pre-line;">
                        {{ $result->writingAnswer->answer }}
                    </div>
                </div>
            </div>

            <div class="card container p-5">
                <h3 class="text-lg font-bold mt-4">Overall Band Scores</h3>
                <ul class="list-disc pl-5 text-sm">
                    <li><strong>Task Response:</strong> {{ $result->task_response ?? 'N/A' }}</li>
                    <li><strong>Coherence and Cohesion:</strong> {{ $result->coherence_cohesion ?? 'N/A' }}
                    </li>
                    <li><strong>Lexical Resource:</strong> {{ $result->vocabulary ?? 'N/A' }}</li>
                    <li><strong>Grammatical Range and Accuracy:</strong>
                        {{ $result->grammar ?? 'N/A' }}</li>
                </ul>
                <h3 class="text-lg font-bold mt-6">Summary</h3>
                <p class="text-sm">{{ $result->evaluation['summary'] ?? 'N/A' }}</p>

                <h3 class="text-lg font-bold mt-6">General Feedback</h3>
                <p class="text-sm">{{ $result->evaluation['general_feedback'] ?? 'N/A' }}</p>

                @php
                    $criteria = [
                        'task_response' => 'Task Response',
                        'coherence_cohesion' => 'Coherence and Cohesion',
                        'vocabulary' => 'Lexical Resource',
                        'grammar' => 'Grammatical Range and Accuracy',
                    ];
                @endphp

                @foreach ($criteria as $key => $label)
                    @php
                        $feedback = $result['evaluation']["{$key}_feedback"] ?? [];
                    @endphp
                    <div class="mt-6">
                        <h4 class="text-md font-semibold">{{ $label }} Feedback</h4>
                        <p class="text-sm mt-1"><strong>Why:</strong> {{ $feedback['score_feedback'] ?? 'N/A' }}</p>
                        <p class="text-sm mt-1"><strong>How to Improve:</strong>
                            {{ $feedback['improvement_advice'] ?? 'N/A' }}</p>
                    </div>
                @endforeach
            </div>

            <a href="{{ route('dashboard.history') }}" class="btn btn-secondary mt-4">Back to History</a>
        </div>
    </div>
@endsection
