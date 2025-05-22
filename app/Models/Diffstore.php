<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Diffstore extends Model
{
    use HasFactory;
    protected $table = "diffstore";
    protected $primaryKey = "id";

    protected $attributes = [
        "key" => "",
        "html" => "",
    ];

    protected $fillable = ["key", "html"];

    public function shouldDeleted(): bool
    {
        $expirationTime = Carbon::parse($this->created_at)->addSeconds(604800);
        return Carbon::now()->greaterThan($expirationTime);
    }

    public function getCreatedCleanAtAttribute($value)
    {
        $date = Carbon::parse($value);

        if ($date->isToday()) {
            return $date->format("H:i") .
                " " .
                __("text.today") .
                " (" .
                $date->diffForHumans() .
                ")";
        }
        return $date->format("H:i d.m.Y") . " (" . $date->diffForHumans() . ")";
    }
}
