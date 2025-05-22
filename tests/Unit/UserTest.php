<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;

class UserTest extends TestCase
{
    public function testLoginMethod()
    {
        $user = User::factory()->create(['username' => 'regular']);
        Auth::login($user);
        $this->assertTrue(Auth::check());
    }
}
