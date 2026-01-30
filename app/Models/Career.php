<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'position',
        'location',
        'posting_at',
        'closing_at',
        'qualification',
        'description',
        'work_type',
        'work_experience',
        'status',
        'thumbnail'
    ];

    protected $casts = [
        'posting_at' => 'date', // format method...
        'closing_at' => 'date', // format method...
    ];

    public function career_applicants()
    {
        return $this->hasMany(CareerApplicant::class);
    }
}
