<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GroqIELTSEvaluator
{
    protected function validateStructure(array $data): bool
    {
        return isset(
            $data['task_response'],
            $data['coherence_cohesion'],
            $data['lexical_resource'],
            $data['grammatical_range_and_accuracy'],
            $data['summary'],
            $data['general_feedback'],
            $data['task_response_feedback']['score_feedback'],
            $data['task_response_feedback']['improvement_advice'],
            $data['coherence_cohesion_feedback']['score_feedback'],
            $data['coherence_cohesion_feedback']['improvement_advice'],
            $data['lexical_resource_feedback']['score_feedback'],
            $data['lexical_resource_feedback']['improvement_advice'],
            $data['grammatical_range_and_accuracy_feedback']['score_feedback'],
            $data['grammatical_range_and_accuracy_feedback']['improvement_advice']
        );
    }

    protected function calculateOverallBandScore($taskResponse, $coherence, $vocabulary, $grammar): float
    {
        return round(($taskResponse + $coherence + $vocabulary + $grammar) / 4, 1);
    }

    public function evaluate(string $transcript): ?array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.groq.key'),
        ])->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => 'compound-beta',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => <<<SYS
You are a certified IELTS examiner. You are grading IELTS Writing Task 2 responses using the official public IELTS Band Descriptors. Your goal is to assign fair, generous, and accurate scores.

🟩 You MUST:
- Assign scores from 1 to 9 (whole bands only: 7, 8, 9 — not 6.5, not 8.5).
- Be generous when the writing meets higher-band standards, even with minor issues.
- Award Band 9 if criteria are met even with rare or occasional lapses.
- Do not penalize small grammar or vocabulary issues if they do not interfere with clarity or task achievement.
- Justify all scores clearly and helpfully.

🟩 Criteria:
1. Task Response
2. Coherence and Cohesion
3. Lexical Resource
4. Grammatical Range and Accuracy

🟩 Output JSON format only:
{
  "task_response": number (1-9),
  "coherence_cohesion": number (1-9),
  "lexical_resource": number (1-9),
  "grammatical_range_and_accuracy": number (1-9),
  "summary": "One-paragraph band justification.",
  "general_feedback": "General improvement advice.",
  "task_response_feedback": {
    "score_feedback": "Why this band?",
    "improvement_advice": "How to improve."
  },
  "coherence_cohesion_feedback": {
    "score_feedback": "Why this band?",
    "improvement_advice": "How to improve."
  },
  "lexical_resource_feedback": {
    "score_feedback": "Why this band?",
    "improvement_advice": "How to improve."
  },
  "grammatical_range_and_accuracy_feedback": {
    "score_feedback": "Why this band?",
    "improvement_advice": "How to improve."
  }
}

Return ONLY the above JSON.

SYS

                        ],
                        [
                            'role' => 'user',
                            'content' => $transcript,
                        ],
                    ],
                    "temperature" => 0.3,
                    "top_p" => 1.0,
                    "frequency_penalty" => 0,
                    "presence_penalty" => 0
                ]);

        $content = $response->json()['choices'][0]['message']['content'] ?? null;

        // Try decoding the JSON
        $parsed = json_decode($content, true);

        // If failed, clean and decode again
        if (!is_array($parsed)) {
            $cleaned = trim($content, "\" \n\r\t");
            $cleaned = stripslashes($cleaned);
            $parsed = json_decode($cleaned, true);
        }

        // Validate and calculate band score
        if (is_array($parsed) && $this->validateStructure($parsed)) {
            $parsed['band_score'] = $this->calculateOverallBandScore(
                $parsed['task_response'],
                $parsed['coherence_cohesion'],
                $parsed['lexical_resource'],
                $parsed['grammatical_range_and_accuracy']
            );
            return $parsed;
        }

        return null;
    }
}
