<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Station extends Model
{
    use HasFactory, Searchable;

    protected $table = 'station';
    protected $primaryKey = 'id';


    protected $attributes = [
        'name' => 'Station',
        'data' => '{}',
    ];

    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'data' => $this->data,
        ];
    }

    protected $fillable = ['name', 'data'];

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}

