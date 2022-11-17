<?php

namespace App\Models;

use App\Cart\Money;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Traits\HasPrice;
use App\Models\ProductVariationType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ProductVariation extends Model
{
    use HasFactory, HasPrice;

    public function type()
    {

        return $this->hasOne(ProductVariationType::class, 'id', 'product_variation_type_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getPriceAttribute($value)
    {
        if ($value === null) {
            return $this->product->price;
        }

        return new Money($value);
    }
    public function priceVaries()
    {
        return $this->price->amount() !== $this->product->price->amount();
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}
