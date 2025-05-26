<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Testrun;

class TestrunUrlTest extends TestCase
{
    public function test_url_attribute_can_be_set()
    {
        $testrun = new Testrun(['url' => 'https://example.com']);
        $this->assertEquals('https://example.com', $testrun->url);
    }
}
