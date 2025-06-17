<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class RssFeed extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'rss_feed';
    protected $primaryKey = 'id';

    /**
     * Database indexes for this model.
     *
     * @var array<int, string>
     */
    protected $indexes = [
        'user',
    ];

    protected $attributes = [
        'name' => 'New RSS Feed',
        'url' => 'https://example.com/feed.xml',
        'user' => 0,
    ];

    protected $fillable = [
        'url',
        'name',
        'user',
        'last_title',
        'last_checked_at',
    ];
}
