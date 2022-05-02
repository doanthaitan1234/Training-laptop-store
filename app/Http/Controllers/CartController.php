<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Image;
use App\Helpers\Custom;
use App\Defines\Define;
use Auth;

class CartController
{
    public function showCart()
    {
        $list_cart = Cart::getCart();
        $count = Cart::getCountCartList();
        $total_price = Cart::getTotalPrice();

        return view('cart-list', compact('list_cart', 'count', 'total_price'));
    }
}
