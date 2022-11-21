<?php

namespace App\Cart;

use App\Models\User;
use NumberFormatter;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;
use App\Http\Requests\Cart\CartStoreRequest;


class Cart
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function add($products)
    {

        $this->user->cart()->syncWithoutDetaching(
            $this->getStorePayload($products)
        );
    }

    protected function getStorePayload($products)
    {
        return collect($products)->keyBy('id')->map(function ($product) {
            return [
                'quantity' => $product['quantity']
            ];
        })->toArray();
    }
}
