<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\OneSkillResult;

class TestReviewed extends Notification
{
    use Queueable;

    public $result;

    public function __construct(OneSkillResult $result)
    {
        $this->result = $result;
    }

    public function via($notifiable)
    {
        return ['database']; // or ['mail', 'database'] if email needed
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "Your {$this->result->skill} test has been reviewed and scored.",
            'band_score' => $this->result->band_score,
            'result_id' => $this->result->id,
            'skill' => $this->result->skill,
        ];
    }
}
