<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyAbout extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'type',
        'icon',
        'thumbnail',
    ];

    public function keypoints()
    {
        return $this->hasMany(CompanyKeyPoint::class);
    }
}
