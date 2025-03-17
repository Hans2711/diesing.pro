<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $user = User::where('username', 'tester')->first();

        dd($user->isAdmin());

        $this->assertTrue($user ? $user->isAdmin() : false);
    }
}
