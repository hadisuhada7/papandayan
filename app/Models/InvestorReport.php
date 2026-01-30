<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvestorReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'investor_reports';

    protected $fillable = [
        'investor_presentation_id',
        'name',
        'report',
    ];

    public function log_download_reports()
    {
        return $this->hasMany(LogDownloadReport::class);
    }
}
