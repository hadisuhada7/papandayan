<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceKeyPoint extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'service_keypoints';

    protected $fillable = [
        'service_id',
        'keypoint',
    ];
}
