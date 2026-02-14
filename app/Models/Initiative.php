<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Kilobyteno\LaravelUserGuestLike\Traits\HasUserGuestLike;

class Initiative extends Model
{
    use HasFactory, HasUuids, SoftDeletes, HasUserGuestLike;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'about',
        'author',
        'viewer',
        'publish_at',
        'status',
        'thumbnail',
    ];

    protected $casts = [
        'publish_at' => 'date', // format method...
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($initiative) {
            if (empty($initiative->slug)) {
                $initiative->slug = static::generateUniqueSlug($initiative->title);
            }
        });

        static::updating(function ($initiative) {
            if ($initiative->isDirty('title') && empty($initiative->slug)) {
                $initiative->slug = static::generateUniqueSlug($initiative->title, $initiative->id);
            }
        });
    }

    /**
     * Generate a unique slug from title.
     */
    public static function generateUniqueSlug($title, $id = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
