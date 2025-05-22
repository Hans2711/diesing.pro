<?php

namespace Tests\Unit;

use App\Models\Diffstore;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class DiffstoreTest extends TestCase
{
    public function test_should_deleted_returns_true_for_old_instance(): void
    {
        $diffstore = new Diffstore();
        $diffstore->timestamps = false;
        $diffstore->created_at = Carbon::now()->subDays(8)->toDateTimeString();

        $this->assertTrue($diffstore->shouldDeleted());
    }

    public function test_should_deleted_returns_false_for_recent_instance(): void
    {
        $diffstore = new Diffstore();
        $diffstore->timestamps = false;
        $diffstore->created_at = Carbon::now()->toDateTimeString();

        $this->assertFalse($diffstore->shouldDeleted());
    }
}
