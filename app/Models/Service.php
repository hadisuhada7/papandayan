<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'about',
        'link_whatsapp',
        'thumbnail',
    ];

    public function keypoints()
    {
        return $this->hasMany(ServiceKeyPoint::class);
    }
}
