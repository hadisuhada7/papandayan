<?php

namespace App\Jobs;

use App\Jobs\NotificationJob;
use App\Models\Question;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TicketingJob implements ShouldQueue
{
    use  Dispatchable, Queueable, InteractsWithQueue, SerializesModels;

    public function __construct(public int $questionId)
    {
    }

    public function handle(): void
    {
        $question = Question::with('question_type')->find($this->questionId);

        if (! $question) {
            return;
        }

        if (Ticket::where('question_id', $question->id)->exists()) {
            return;
        }

        Ticket::createFromQuestion($question);

        NotificationJob::dispatch($question->id);
    }
}
