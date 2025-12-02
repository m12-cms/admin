<?php

namespace Tests\Feature\Filament\Users;

use M12\Models\User;
use Tests\TestCase;

class ListUsersPageTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    public function test_users_page_loads(): void
    {
        $this->get('/admin/users')
        ->assertOk();
    }
}
