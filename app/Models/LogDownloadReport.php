<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogDownloadReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'type_report',
        'ip_address',
        'status',
        'downloaded_at',
        'document_report_id',
        'annual_report_id',
        'financial_report_id',
        'investor_report_id',
        'stock_report_id',
        'shareholder_report_id',
    ];

    protected $casts = [
        'downloaded_at' => 'datetime', // format method...
    ];

    public function documentReport()
    {
        return $this->belongsTo(DocumentReport::class, 'document_report_id');
    }

    public function annualReport()
    {
        return $this->belongsTo(AnnualReport::class, 'annual_report_id');
    }

    public function financialStatement()
    {
        return $this->belongsTo(FinancialReport::class, 'financial_report_id');
    }

    public function investorReport()
    {
        return $this->belongsTo(InvestorReport::class, 'investor_report_id');
    }

    public function stockReport()
    {
        return $this->belongsTo(StockReport::class, 'stock_report_id');
    }

    public function shareholderReport()
    {
        return $this->belongsTo(ShareholderReport::class, 'shareholder_report_id');
    }
    
}
