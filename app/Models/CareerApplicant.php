<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CareerApplicant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'bod',
        'education',
        'major',
        'experienced',
        'current_salary',
        'expectation_salary',
        'status',
        'reject_reason',
        'curriculum_vitae',
        'career_id',
        'experienced_id'
    ];

    protected $casts = [
        'bod' => 'date', // format method...
    ];

    public function career()
    {
        return $this->belongsTo(Career::class, 'career_id');
    }

    public function experienced_applicant()
    {
        return $this->belongsTo(ExperiencedApplicant::class, 'experienced_id');
    }
}
