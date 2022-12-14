<?php

namespace Tests\Feature\Cart;

use App\Models\ProductVariation;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartUpdateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_fails_if_unauthenticated()
    {
        $this->json('PATCH', 'api/cart/1')
            ->assertStatus(401);
    }
    public function test_it_fails_if_product_cant_be_found()
    {
        $user = User::factory()->create();
        $this->jsonAs($user, 'PATCH', 'api/cart/1')
            ->assertStatus(404);
    }

    public function test_it_fails_requires_a_quantity()
    {
        $user = User::factory()->create();
        $product = ProductVariation::factory()->create();
        $this->jsonAs($user, 'PATCH', "api/cart/$product->id")
            ->assertJsonValidationErrors(['quantity']);
    }
    public function test_it_fails_requires_a_numeric_quantity()
    {
        $user = User::factory()->create();
        $product = ProductVariation::factory()->create();
        $this->jsonAs($user, 'PATCH', "api/cart/$product->id", [
            'quantity' => 'one'
        ])
            ->assertJsonValidationErrors(['quantity']);
    }
    public function test_it_fails_requires_a_quantity_of_one_or_more()
    {
        $user = User::factory()->create();
        $product = ProductVariation::factory()->create();
        $this->jsonAs($user, 'PATCH', "api/cart/$product->id", [
            'quantity' => 0
        ])
            ->assertJsonValidationErrors(['quantity']);
    }

    public function test_it_update_the_quantity_of_a_product()
    {
        $user = User::factory()->create();

        $user->cart()->attach(
            $product = ProductVariation::factory()->create(),
            [
                'quantity' => 1
            ]
        );
        $this->jsonAs($user, 'PATCH', "api/cart/$product->id", [
            'quantity' => $quantity  = 5
        ]);
        $this->assertDatabaseHas('cart_user', [
            'product_variation_id' => $product->id,
            'quantity' => $quantity
        ]);
    }
}
