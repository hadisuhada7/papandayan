<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuNavigation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'url',
        'is_active',
        'icon',
        'menu_group_id',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function menu_group()
    {
        return $this->belongsTo(MenuGroup::class, 'menu_group_id');
    }

    public function banner()
    {
        return $this->hasMany(HeroSection::class);
    }
}
