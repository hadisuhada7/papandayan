<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailConfig extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'host',
        'port',
        'username',
        'password',
        'encryption',
        'from_address',
        'from_name',
        'is_active',
    ];
}