<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'message',
        'status',
        'question_type_id'
    ];

    public function question_type()
    {
        return $this->belongsTo(QuestionType::class, 'question_type_id');
    }

    public function ticket()
    {
        return $this->hasOne(Ticket::class);
    }
}
