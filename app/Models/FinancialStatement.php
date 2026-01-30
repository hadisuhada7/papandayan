<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancialStatement extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'financial_statements';

    protected $fillable = [
        'title',
        'status',
        'publish_at',
    ];

    protected $casts = [
        'publish_at' => 'date', // format method...
    ];

    public function financialReports()
    {
        return $this->hasMany(FinancialReport::class);
    }
}
