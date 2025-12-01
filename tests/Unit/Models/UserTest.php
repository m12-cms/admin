<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use M12\Models\User;

class UserTest extends TestCase
{
    public function test_user_has_name()
    {
        $user = User::factory()->create(['name' => 'John']);
        $this->assertEquals('John', $user->name);
    }
}
