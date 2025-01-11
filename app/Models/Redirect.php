<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    protected $table = "redirect";
    protected $primaryKey = "id";

    protected $attributes = [
        "name" => "Neue Weiterleitung",
        "slug" => "neue-weiterleitung",
        "target" => "https://www.diesing.pro",
        "code" => "302",
        "user" => 0,
    ];

    public function toArray()
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "target" => $this->target,
            "code" => $this->code,
            "url" => $this->url,
            "user" => $this->user,
        ];
    }

    public function __construct()
    {
        parent::__construct();
    }

    public function getUrlAttribute()
    {
        return url("/r/" . $this->slug);
    }

    public function workRedirect()
    {
        $baseSlug = str_replace(" ", "-", strtolower($this->name));
        $originalSlug = $baseSlug;

        $count = 1;
        while (
            self::where("slug", $baseSlug)
                ->where("id", "!=", $this->id)
                ->exists()
        ) {
            $baseSlug = $originalSlug . "-" . $this->id;
            $count++;
        }

        $this->slug = $baseSlug;
    }

    protected $fillable = ["name", "slug", "target", "code", "user"];
}
