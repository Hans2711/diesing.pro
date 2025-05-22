<?php

namespace Tests\Unit;

use App\Models\Timetrack;
use Tests\TestCase;

class TimetrackTest extends TestCase
{
    public function test_make_instance_creates_model_with_attributes(): void
    {
        $title = 'Custom Title';
        $timesJson = json_encode([['title' => 'foo', 'time' => '2024-01-01T00:00', 'duration' => 30]]);

        $timetrack = Timetrack::makeInstance($title, $timesJson);

        $this->assertInstanceOf(Timetrack::class, $timetrack);
        $this->assertSame($title, $timetrack->title);
        $this->assertEquals(json_decode($timesJson, true), $timetrack->times);
    }

    public function test_times_accessor_decodes_json(): void
    {
        $timetrack = new Timetrack();
        $timesJson = json_encode([['title' => 'bar']]);
        $timetrack->times = $timesJson;

        $this->assertEquals(json_decode($timesJson, true), $timetrack->times);
    }
}
