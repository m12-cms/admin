<?php

namespace Tests\Feature\Auth;

use M12\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_login_page_loads(): void
    {
        $this->get('/admin/login')
            ->assertOk();
    }

    public function test_user_can_access_panel_after_auth(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->get('/admin')
            ->assertOk();
    }

    public function test_guest_is_redirected_from_panel(): void
    {
        $this->get('/admin')
            ->assertRedirect('/admin/login');
    }
}
