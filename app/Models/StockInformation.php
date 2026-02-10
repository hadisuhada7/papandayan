<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockInformation extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'stock_informations';

    protected $fillable = [
        'title',
        'status',
        'publish_at',
    ];

    protected $casts = [
        'publish_at' => 'date', // format method...
    ];

    public function stockReports()
    {
        return $this->hasMany(StockReport::class);
    }
}
