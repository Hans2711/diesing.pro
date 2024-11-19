<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Testinstance extends Model
{
    protected $table = 'testinstance';
    protected $primaryKey = 'id';

    protected $attributes = [
        'html' => '',
        'headers' => '',
    ];

    protected $fillable = ['html', 'headers'];

    public function testrun()
    {
        return $this->belongsTo(Testrun::class, "testrun_id", "id");
    }

    public function fetch() {
        $url = $this->testrun->testobject->url;
        $client = new Client();

        try {
            $response = $client->get($url);
            $this->html = $response->getBody();
            $this->headers= json_encode($response->getHeaders(), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        } catch (RequestException $e) {
            $this->html = $e->getMessage();
        }

        $this->save();
    }
}


