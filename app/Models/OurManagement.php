<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OurManagement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'occupation',
        'avatar',
        'facebook',
        'instagram',
        'twitter',
        'linkedin',
    ];
}
