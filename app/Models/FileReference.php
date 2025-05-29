<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FileReference extends Model
{
    use HasFactory, HasUuids;
    protected $table = "file_reference";
    protected $primaryKey = "id";

    protected $attributes = [
        "path" => "",
        "model" => "",
        "foreign_id" => -1,
    ];

    protected $fillable = ["path", "model", "foreign_id"];
}
