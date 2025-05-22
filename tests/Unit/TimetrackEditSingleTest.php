<?php

namespace Tests\Unit;

use App\Livewire\TimetrackEditSingle;
use Tests\TestCase;
use ReflectionMethod;

class TimetrackEditSingleTest extends TestCase
{
    public function test_to_minutes_converts_various_formats(): void
    {
        $component = new TimetrackEditSingle();
        $method = new ReflectionMethod($component, 'toMinutes');
        $method->setAccessible(true);

        $this->assertSame(90, $method->invoke($component, '90'));
        $this->assertSame(60, $method->invoke($component, '1h'));
        $this->assertSame(90, $method->invoke($component, '1h 30m'));
        $this->assertSame(90, $method->invoke($component, '1h30m'));
        $this->assertSame(45, $method->invoke($component, '45m'));
    }
}
