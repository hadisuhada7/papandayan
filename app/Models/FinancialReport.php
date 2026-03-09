<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancialReport extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'financial_reports';

    protected $fillable = [
        'financial_statement_id',
        'name',
        'report',
        'original_filename',
    ];

    public function log_download_reports()
    {
        return $this->hasMany(LogDownloadReport::class);
    }

    public function financialStatement()
    {
        return $this->belongsTo(FinancialStatement::class, 'financial_statement_id');
    }
}
