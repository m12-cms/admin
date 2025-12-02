<?php

namespace Tests\Unit\Models;

use M12\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_user_factory_creates_valid_user(): void
    {
        $user = User::factory()->create();

        $this->assertNotNull($user->id);
        $this->assertNotEmpty($user->email);
        $this->assertNotEmpty($user->password);
    }

    public function test_soft_deletes_work(): void
    {
        $user = User::factory()->create();
        $user->delete();

        $this->assertSoftDeleted($user);
    }

    public function test_hidden_attributes_are_hidden_in_arrays(): void
    {
        $user = User::factory()->create([
            'password' => 'dummy',
        ]);

        $array = $user->toArray();

        $this->assertArrayNotHasKey('password', $array);
        $this->assertArrayNotHasKey('remember_token', $array);
    }
}
