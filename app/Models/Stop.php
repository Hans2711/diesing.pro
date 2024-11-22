<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stop extends Model
{
    protected $attributes = [
        "type" => "",
        "id" => "",
        "name" => "",
        "location" => "{}",
        "products" => "{}",
        "distance" => 0,
        "entrances" => "{}",
    ];

    public function getProductsAttribute($value)
    {
        return json_decode($value);
    }

    public function getLocationAttribute($value)
    {
        return json_decode($value);
    }

    public function getEntrancesAttribute($value)
    {
        return json_decode($value);
    }
}
