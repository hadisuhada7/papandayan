<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SafetyManagement extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'safety_managements';

    protected $fillable = [
        'title',
        'about',
    ];
}
