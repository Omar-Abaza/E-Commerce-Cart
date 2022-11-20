<?php

namespace Tests\Unit\Models\Users;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_hashes_the_password_while_creating()
    {
        $user = User::factory()->create([
            'password' => 'cats',
        ]);

        $this->assertNotEquals($user->password, 'cats');

    }
}
