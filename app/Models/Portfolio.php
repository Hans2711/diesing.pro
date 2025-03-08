<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Portfolio extends Model
{
    protected $table = "portfolio";
    protected $primaryKey = "id";

    protected $attributes = [
        "name" => "New Portfoilio Entry",
        "url" => "",
        "description" => "",
        "user" => 0,
    ];

    protected $fillable = ["name", "url", "description"];
}
