<?php

namespace Tests\Unit\Models\Products;

use App\Cart\Money;
use Tests\TestCase;
use App\Models\Stock;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductVariationType;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductVariationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_has_one_variation_type()
    {
        $variation = ProductVariation::factory()->create();

        $this->assertInstanceOf(ProductVariationType::class, $variation->type);
    }

    public function test_it_belongs_to_a_product()
    {
        $variation = ProductVariation::factory()->create();

        $this->assertInstanceOf(Product::class, $variation->product);
    }

    public function test_it_returns_a_money_for_instance_price()
    {
        $variation = ProductVariation::factory()->create();

        $this->assertInstanceOf(Money::class, $variation->price);
    }

    public function test_it_returns_a_formatted_price()
    {
        $variation = ProductVariation::factory()->create([
            'price' => 1050
        ]);

        $this->assertEquals("EGP 10.50", $variation->formattedPrice);
    }
    public function test_it_returns_the_product_price_if_price_is_null()
    {
        $product = Product::factory()->create([
            'price' => 1050
        ]);
        $variation = ProductVariation::factory()->create([
            'price' => null,
            'product_id' => $product->id
        ]);

        $this->assertEquals($product->price->amount(), $variation->price->amount());
    }

    public function test_it_can_check_if_the_variation_price_is_different_to_the_product()
    {
        $product = Product::factory()->create([
            'price' => 1050
        ]);
        $variation = ProductVariation::factory()->create([
            'price' => 2000,
            'product_id' => $product->id
        ]);

        $this->assertTrue($variation->priceVaries());
    }

    public function test_it_has_many_stocks()
    {
        $variation = ProductVariation::factory()->create();

        $variation->stocks()->save(
            Stock::factory()->make()
        );

        $this->assertInstanceOf(Stock::class, $variation->stocks->first());
    }

    public function test_it_has_stock_information()
    {
        $variation = ProductVariation::factory()->create();

        $variation->stocks()->save(
            Stock::factory()->make()
        );

        $this->assertInstanceOf(ProductVariation::class, $variation->stock->first());
    }

    public function test_it_has_stock_count_pivot_within_stock_information()
    {
        $variation = ProductVariation::factory()->create();

        $variation->stocks()->save(
            Stock::factory()->make([
                'quantity' => $quantity = 5
            ])
        );

        $this->assertEquals($variation->stock->first()->pivot->stock, $quantity );
    }

    public function test_it_has_in_stock_pivot_within_stock_information()
    {
        $variation = ProductVariation::factory()->create();

        $variation->stocks()->save(
            Stock::factory()->make()
        );

        $this->assertEquals($variation->stock->first()->pivot->in_stock,1);
    }

    public function test_it_can_check_if_its_in_stock()
    {
        $variation = ProductVariation::factory()->create();

        $variation->stocks()->save(
            Stock::factory()->make()
        );

        $this->assertTrue($variation->inStock());
    }

    public function test_it_can_get_stock_count()
    {
        $variation = ProductVariation::factory()->create();

        $variation->stocks()->save(
            Stock::factory()->make([
                'quantity' =>  5
            ])
        );

        $variation->stocks()->save(
            Stock::factory()->make([
                'quantity' =>  5
            ])
        );

        $this->assertEquals($variation->stockCount(), 10 );
    }
}
