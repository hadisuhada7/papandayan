<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogEmailSender extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'question_id',
        'ticket_id',
        'recipient_email',
        'subject',
        'template',
        'body',
        'status',
        'fail_interval',
        'error_message',
        'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
        'fail_interval' => 'integer',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
