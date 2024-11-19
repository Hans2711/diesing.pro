<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Testobject extends Model
{
    protected $table = 'testobject';
    protected $primaryKey = 'id';

    protected $attributes = [
        'name' => 'Testobject',
        'url' => '',
    ];

    protected $fillable = ['name', 'url'];

    public function testruns() : HasMany
    {
        return $this->hasMany(Testrun::class, 'testobject_id', 'id')->orderBy('created_at', 'desc');
    }
}
