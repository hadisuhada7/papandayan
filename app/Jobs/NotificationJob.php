<?php

namespace App\Jobs;

use App\Models\Question;
use App\Models\Ticket;
use App\Services\EmailService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $questionId)
    {
    }

    public function handle(EmailService $emailService): void
    {
        $question = Question::find($this->questionId);

        if (! $question) {
            return;
        }

        $ticket = Ticket::where('question_id', $question->id)->latest('id')->first();

        $emailService->sendAutoResponseCustomer($question, $ticket);
        $emailService->sendNotificationAdmin($question, $ticket);
    }
}
