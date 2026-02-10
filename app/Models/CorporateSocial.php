<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kilobyteno\LaravelUserGuestLike\Traits\HasUserGuestLike;

class CorporateSocial extends Model
{
    use HasFactory, HasUuids, SoftDeletes, HasUserGuestLike;

    protected $keyType = 'string';

    public $incrementing = false;

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
