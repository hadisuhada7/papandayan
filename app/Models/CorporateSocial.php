<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Kilobyteno\LaravelUserGuestLike\Traits\HasUserGuestLike;

class CorporateSocial extends Model
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
        'viewer' => 'integer',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($social) {
            if (empty($social->slug)) {
                $social->slug = static::generateUniqueSlug($social->title);
            }
        });

        static::updating(function ($social) {
            if ($social->isDirty('title')) {
                $social->slug = static::generateUniqueSlug($social->title, $social->id);
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
