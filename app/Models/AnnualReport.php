<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnnualReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'report',
        'status',
        'thumbnail',
    ];

    public function log_download_reports()
    {
        return $this->hasMany(LogDownloadReport::class);
    }
}
