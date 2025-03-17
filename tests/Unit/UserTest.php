<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $user = User::where('username', 'tester')->first();

        $this->assertTrue($user ? $user->isAdmin() : false);
    }
}
