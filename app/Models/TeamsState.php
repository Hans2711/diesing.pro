<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TeamsState extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'teams_state';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user',
        'players',
        'teams',
        'number_of_teams',
        'teams_locked',
        'games',
    ];

    protected $casts = [
        'players' => 'array',
        'teams' => 'array',
        'games' => 'array',
        'teams_locked' => 'boolean',
        'number_of_teams' => 'integer',
    ];
}
