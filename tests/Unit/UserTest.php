<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;

class UserTest extends TestCase
{
    public function testTesterIsAdmin(): void
    {
        $user = User::where('username', 'tester')->first();

        $this->assertTrue($user ? $user->isAdmin() : false);
    }

    public function testLoginMethod()
    {
        Auth::login(User::where('username', 'tester')->first());
        $this->assertTrue(Auth::check());
    }
}
