<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HeroSection extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'heading',
        'subheading',
        'link',
        'banner',
        'menu_navigation_id',
    ];

    public function menu_navigation()
    {
        return $this->belongsTo(MenuNavigation::class, 'menu_navigation_id');
    }
}
