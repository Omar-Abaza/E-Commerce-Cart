<?php

namespace Tests\Unit\Models\Users;

use App\Models\ProductVariation;
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
    public function test_it_has_many_cart_products()
    {
        $user = User::factory()->create();
        $user->cart()->attach(

            ProductVariation::factory()->create()
        );

        $this->assertInstanceOf(ProductVariation::class, $user->cart->first());
    }

    public function test_it_has_a_quantity_for_each_cart_products()
    {
        $user = User::factory()->create();
        $user->cart()->attach(

            ProductVariation::factory()->create() , [
                'quantity' => $quantity = 5
            ]
        );

        $this->assertEquals($user->cart->first()->pivot->quantity, $quantity);
    }
}
