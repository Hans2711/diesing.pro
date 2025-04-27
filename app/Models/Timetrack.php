<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetrack extends Model
{
    protected $table = "timetrack";
    protected $primaryKey = "id";

    protected $attributes = [
        'title'  => 'New Timetrack',
        'times' => '[]',
    ];

    public static function makeInstance($title, $times) {
        $timetrack = new self();

        $timetrack->title = $title;
        $timetrack->times = $times;

        return $timetrack;
    }

    public function getTimesAttribute($value) {
        return json_decode($value, true);
    }
}

