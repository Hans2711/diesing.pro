<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedirectHit extends Model
{
    protected $table = "redirect_hit";
    protected $primaryKey = "id";

    protected $attributes = [
        'ip' => '',
        'geo'  => '',
        'agent' => '',
        'redirect' => '',
    ];

    public static function makeInstance($redirect) {
        $hit = new self();

        $hit->ip = $_SERVER['REMOTE_ADDR'];
        $hit->agent = $_SERVER['HTTP_USER_AGENT'];
        $hit->redirect = $redirect->id;

        return $hit;
    }
}
