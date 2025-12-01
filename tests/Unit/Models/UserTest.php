<?php

namespace Tests\Unit\Models;

use M12\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_user_has_name()
    {
        $user = User::factory()->create(['name' => 'John']);
        $this->assertEquals('John', $user->name);
    }
}
