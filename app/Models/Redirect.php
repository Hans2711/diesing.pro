<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    use HasFactory, HasUuids;
    protected $table = "redirect";
    protected $primaryKey = "id";

    /**
     * Database indexes for this model.
     *
     * @var array<int, string>
     */
    protected $indexes = ["slug", "user"];

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
            "hits" => $this->getRecentHits(),
            "hitsCount" => $this->getHits()->count(),
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

    public function getHits() {
        return RedirectHit::where("redirect", $this->id)->get();
    }

    public function getRecentHits() {
        return RedirectHit::where("redirect", $this->id)
            ->orderBy("created_at", "desc")
            ->limit(4)
            ->get();
    }

    protected $fillable = ["name", "slug", "target", "code", "user"];
}
