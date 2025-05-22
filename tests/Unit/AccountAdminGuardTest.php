<?php

namespace Tests\Unit;

use App\Livewire\Account;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountAdminGuardTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_admin_cannot_delete_user(): void
    {
        $nonAdmin = User::factory()->create(['username' => 'regular']);
        $target = User::factory()->create();

        $this->actingAs($nonAdmin);

        Livewire::test(Account::class)
            ->call('deleteUser', $target->id)
            ->assertForbidden();
    }

    public function test_non_admin_cannot_login_user(): void
    {
        $nonAdmin = User::factory()->create(['username' => 'regular']);
        $target = User::factory()->create();

        $this->actingAs($nonAdmin);

        Livewire::test(Account::class)
            ->call('loginUser', $target->id)
            ->assertForbidden();
    }
}
