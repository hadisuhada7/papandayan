<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuGroup extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'order',
    ];

    public function menu_navigations()
    {
        return $this->hasMany(MenuNavigation::class);
    }
}
