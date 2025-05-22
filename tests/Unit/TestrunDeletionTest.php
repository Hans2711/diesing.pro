<?php

namespace Tests\Unit;

use App\Models\Testobject;
use App\Models\Testrun;
use Carbon\Carbon;
use Tests\TestCase;

class TestrunDeletionTest extends TestCase
{
    public function test_should_be_deleted_when_past_expiration(): void
    {
        $deleteAfter = 3600;
        $testobject = new Testobject(['delete_after' => $deleteAfter]);

        $testrun = new Testrun();
        $testrun->timestamps = false;
        $testrun->created_at = Carbon::now()->subHour();
        $testrun->setRelation('testobject', $testobject);

        $this->assertTrue($testrun->shouldDeleted());

        $expectedTime = Carbon::parse($testrun->created_at)
            ->addSeconds($deleteAfter)
            ->format('H:i');
        $this->assertStringContainsString($expectedTime, $testrun->deletedWhen());
    }

    public function test_recent_testrun_should_not_be_deleted(): void
    {
        $testobject = new Testobject(['delete_after' => 3600]);

        $testrun = new Testrun();
        $testrun->timestamps = false;
        $testrun->created_at = Carbon::now();
        $testrun->setRelation('testobject', $testobject);

        $this->assertFalse($testrun->shouldDeleted());
    }
}
