<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shareholder extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'shareholders';

    protected $fillable = [
        'title',
        'status',
        'publish_at',
    ];

    protected $casts = [
        'publish_at' => 'date', // format method...
    ];

    public function shareholderReports()
    {
        return $this->hasMany(ShareholderReport::class);
    }
}
