<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvestorPresentation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'investor_presentations';

    protected $fillable = [
        'title',
        'status',
        'publish_at',
    ];

    protected $casts = [
        'publish_at' => 'date', // format method...
    ];

    public function log_download_reports()
    {
        return $this->hasMany(LogDownloadReport::class);
    }

    public function investorReports()
    {
        return $this->hasMany(InvestorReport::class, 'investor_presentation_id');
    }
}
