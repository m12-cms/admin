<?php

namespace Tests\Feature;

use M12\Models\User;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    public function test_dashboard_requires_auth(): void
    {
        $this->get('/admin')
            ->assertRedirect('/admin/login');
    }

    public function test_dashboard_loads_when_authenticated(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get('/admin')
            ->assertOk();
    }
}
