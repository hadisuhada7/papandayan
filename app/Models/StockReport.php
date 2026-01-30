<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'stock_reports';

    protected $fillable = [
        'stock_information_id',
        'name',
        'report',
    ];

    public function log_download_reports()
    {
        return $this->hasMany(LogDownloadReport::class);
    }

    public function stockInformation()
    {
        return $this->belongsTo(StockInformation::class, 'stock_information_id');
    }
}
