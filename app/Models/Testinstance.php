<?php

namespace App\Models;

use App\Utilities\DiffUtility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Carbon;

class Testinstance extends Model
{
    use HasFactory;
    protected $table = "testinstance";
    protected $primaryKey = "id";

    protected $attributes = [
        "html" => "",
        "headers" => "",
    ];

    protected $fillable = ["html", "headers"];

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

    public function testrun()
    {
        return $this->belongsTo(Testrun::class, "testrun_id", "id");
    }

    public function diff(
        $instance,
        $renderName = "Inline",
        $differOptions = [],
        $rendererOptions = []
    ) {
        return DiffUtility::diff(
            $this->html,
            $instance->html,
            $renderName,
            $differOptions,
            $rendererOptions
        );
    }

    public function fetch()
    {
        $url = $this->testrun->testobject->url;
        $client = new Client();

        try {
            $response = $client->get($url);
            $this->html = $response->getBody();
            $this->headers = json_encode(
                $response->getHeaders(),
                JSON_PRETTY_PRINT |
                    JSON_UNESCAPED_SLASHES |
                    JSON_UNESCAPED_UNICODE
            );
        } catch (RequestException $e) {
            $this->html = $e->getMessage();
        }

        $this->save();
    }
}
