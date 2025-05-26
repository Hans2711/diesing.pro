<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Testrun extends Model
{
    use HasFactory;
    protected $table = "testrun";
    protected $primaryKey = "id";

    protected $attributes = [];

    protected $fillable = ['testobject_id', 'name', 'url'];

    public function shouldDeleted(): bool
    {
        if (!$this->testobject || !$this->testobject->delete_after) {
            return false;
        }

        $deleteAfter = $this->testobject->delete_after;

        $expirationTime = Carbon::parse($this->created_at)->addSeconds(
            $deleteAfter
        );
        return Carbon::now()->greaterThan($expirationTime);
    }

    public function deletedWhen(): string
    {
        if (!$this->testobject || !$this->testobject->delete_after) {
            return "No deletion scheduled";
        }

        $deleteAfter = $this->testobject->delete_after;
        $deletionTime = Carbon::parse($this->created_at)->addSeconds(
            $deleteAfter
        );

        if ($deletionTime->isToday()) {
            return $deletionTime->format("H:i") .
                " Today (" .
                $deletionTime->diffForHumans() .
                ")";
        }
        return $deletionTime->format("H:i d.m.Y") .
            " (" .
            $deletionTime->diffForHumans() .
            ")";
    }

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

    public function testobject()
    {
        return $this->belongsTo(Testobject::class, "testobject_id", "id");
    }

    public function testinstances(): HasMany
    {
        return $this->hasMany(Testinstance::class, "testrun_id", "id")->orderBy(
            "created_at",
            "desc"
        );
    }
}
