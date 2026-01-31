<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
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
     * Get the tags for the article.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag');
    }
}
