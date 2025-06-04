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

    protected $fillable = [
        'url',
        'user',
        'last_title',
        'last_checked_at',
    ];
}
