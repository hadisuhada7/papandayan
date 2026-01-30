<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancialReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'financial_reports';

    protected $fillable = [
        'financial_statement_id',
        'name',
        'report',
    ];

    public function log_download_reports()
    {
        return $this->hasMany(LogDownloadReport::class);
    }
}
