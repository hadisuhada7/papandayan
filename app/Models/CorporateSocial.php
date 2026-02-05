<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CorporateSocial extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'subtitle',
        'about',
        'author',
        'viewer',
        'publish_at',
        'status',
        'thumbnail',
    ];

    protected $casts = [
        'publish_at' => 'date', // format method...
        'viewer' => 'integer',
    ];
}
