<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Testrun extends Model
{
    protected $table = 'testrun';
    protected $primaryKey = 'id';

    protected $attributes = [];

    public function testobject()
    {
        return $this->belongsTo(Testobject::class, "testobject_id", "id");
    }

    public function testinstances() : HasMany
    {
        return $this->hasMany(Testinstance::class, 'testrun_id', 'id')->orderBy('created_at', 'desc');
    }
}

