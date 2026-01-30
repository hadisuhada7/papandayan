<?php

namespace App\Models;

use App\Enums\TicketStatus;
use App\Helpers\TicketNumberHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ticket_number',
        'question_id',
        'subject',
        'message',
        'requester_name',
        'requester_email',
        'requester_phone',
        'status',
        'priority',
        'channel',
        'response_message',
        'responded_at',
    ];

    protected $casts = [
        'status' => TicketStatus::class,
        'responded_at' => 'datetime',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public static function createFromQuestion(Question $question): self
    {
        return self::create([
            'ticket_number' => TicketNumberHelper::generate(),
            'question_id' => $question->id,
            'subject' => $question->question_type?->name ?? 'Website Inquiry',
            'message' => $question->message,
            'requester_name' => $question->name,
            'requester_email' => $question->email,
            'requester_phone' => $question->phone_number,
            'status' => TicketStatus::New,
            'priority' => 'normal',
            'channel' => 'website',
        ]);
    }
}