<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $attributes = [
        "id" => "",
        "stop" => "",
        "when" => "",
        "plannedWhen" => "",
        "delay" => "",
        "platform" => "",
        "plannedPlatform" => null,
        "prognosedPlatform" => null,
        "prognosisType" => null,
        "direction" => null,
        "provenance" => "",
        "line" => "{}",
        "remarks" => "{}",
        "origin" => "",
        "destination" => null,
        "cancelled" => false,
    ];

    public function getLineAttribute($value)
    {
        return json_decode($value);
    }

    public function getRemarksAttribute($value)
    {
        return json_decode($value);
    }
}
