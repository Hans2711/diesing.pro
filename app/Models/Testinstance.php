<?php

namespace App\Models;

use App\Utilities\DiffUtility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
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

    public static function fetchAll(array $instances, int $concurrency = 5): void
    {
        $client = new Client();

        $requests = function () use ($instances) {
            foreach ($instances as $instance) {
                $url = $instance->testrun->url ?? $instance->testrun->testobject->url;
                yield new Request('GET', $url);
            }
        };

        $pool = new Pool($client, $requests(), [
            'concurrency' => $concurrency,
            'fulfilled' => function ($response, $index) use ($instances) {
                $instance = $instances[$index];
                $instance->html = (string) $response->getBody();
                $instance->headers = json_encode(
                    $response->getHeaders(),
                    JSON_PRETTY_PRINT |
                        JSON_UNESCAPED_SLASHES |
                        JSON_UNESCAPED_UNICODE
                );
            },
            'rejected' => function ($reason, $index) use ($instances) {
                $instance = $instances[$index];
                $instance->html = $reason instanceof RequestException ? $reason->getMessage() : (string) $reason;
            },
        ]);

        $pool->promise()->wait();

        foreach ($instances as $instance) {
            $instance->save();
        }
    }

    public function fetch(): void
    {
        self::fetchAll([$this]);
    }
}
