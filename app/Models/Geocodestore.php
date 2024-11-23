<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Geocodestore extends Model
{
    protected $table = 'geocodestore';
    protected $primaryKey = 'id';

    protected $attributes = [
        'key' => '',
        'content' => '',
    ];

    protected $fillable = ['key', 'content'];
}
