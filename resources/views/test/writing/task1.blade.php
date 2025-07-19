@extends('test.writing.template')

@section('title', 'Writing Task 1')

@section('content')
    <div class="task-box">
        Part 1<br />
        You should spend about 20 minutes on this task. Write at least 150 words.
    </div>

    <div class="main active">
        <div class="left">
            <div class="prompt" style="white-space: pre-line;">
                {{ $test->prompt }}
            </div>
            <img src="{{ '/storage/' . $test->media_path }}" alt="Chart is not loading" class="chart" />
        </div>
        <div class="right">
            <form id="taskForm1" method="POST" action="{{ route('test.submit') }}">
                @csrf
                <input name="mock_test_id" value="{{ $test->id }}" hidden>
                <input name="skill" value="{{ $test->skill }}" hidden>
                <input name="task_type" value="{{ $test->task_type }}" hidden>


                <textarea id="response1" name="answer" class="form-control" placeholder="Write your answer here..." required
                    autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"></textarea>
                <div class="word-count">Words: <input type="text" value="0" id="wordCount1" name="word-count" readonly></div>
                <div>
                    <button id="submit" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const textarea = document.getElementById('response1');
        const wordCount = document.getElementById('wordCount1');
        const overlay = document.getElementById('overlay');

        function updateWordCount() {
            const words = textarea.value.trim().split(/\s+/).filter(w => w.length > 0);
            wordCount.value = `${words.length}`;
        }

        textarea.addEventListener('input', updateWordCount);

        // ⏱ Timer for 20 minutes
        let duration = 20 * 60;
        const timerEl = document.getElementById('timer');

        const countdown = setInterval(() => {
            const minutes = String(Math.floor(duration / 60)).padStart(2, '0');
            const seconds = String(duration % 60).padStart(2, '0');
            timerEl.textContent = `${minutes}:${seconds}`;
            duration--;

            if (duration < 0) {
                clearInterval(countdown);
                timerEl.textContent = 'Your time is up!';
            }
        }, 1000);
    </script>
@endsection
