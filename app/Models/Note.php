<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Note extends Model
{
    use HasFactory, HasUuids;
    protected $table = "note";
    protected $primaryKey = "id";

    /**
     * Database indexes for this model.
     *
     * @var array<int, string>
     */
    protected $indexes = ["slug", "user"];

    protected $attributes = [
        "name" => "Neue Notiz",
        "content" => "",
        "share" => 0,
        "slug" => "neue-notiz",
        "enable_password" => 0,
        "password" => "",
        "user" => 0,
    ];

    public function toArray()
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "content" => $this->content,
            "share" => $this->share,
            "slug" => $this->slug,
            "url" => url("/notiz/" . $this->slug),
            "enable_password" => $this->enable_password,
            "password" => $this->password,
            "user" => $this->user,
        ];
    }

    public function __construct()
    {
        parent::__construct();

        $this->name = $this->attributes["name"];
        $this->user = Auth::user()?->id;
    }

    public function getPublicUrl()
    {
        return url("/n/" . $this->slug);
    }

    protected $fillable = [
        "name",
        "content",
        "share",
        "slug",
        "enable_password",
        "password",
        "user",
    ];
}
