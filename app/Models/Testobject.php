<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Testobject extends Model
{
    use HasFactory, HasUuids;
    protected $table = "testobject";
    protected $primaryKey = "id";

    protected $attributes = [
        "name" => "Testobject",
        "url" => "",
        "delete_after" => 86400,
        "user" => 0,
        "sitemaps" => "[]",
    ];

    protected $fillable = ["name", "url", "delete_after", "user", "sitemaps"];

    protected $casts = [
        'sitemaps' => 'array',
    ];

    public function getCreatedAtCleanAttribute($value)
    {
        $date = Carbon::parse($this->created_at);

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

    public function testruns(): HasMany
    {
        return $this->hasMany(Testrun::class, "testobject_id", "id")->orderBy(
            "created_at",
            "desc"
        );
    }
}
