<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvestorReport extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'investor_reports';

    protected $fillable = [
        'investor_presentation_id',
        'name',
        'report',
        'original_filename',
    ];

    public function log_download_reports()
    {
        return $this->hasMany(LogDownloadReport::class);
    }

    public function investorPresentation()
    {
        return $this->belongsTo(InvestorPresentation::class, 'investor_presentation_id');
    }
}
