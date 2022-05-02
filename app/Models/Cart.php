<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;
use Auth;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function getCountCartList()
    {
        if ($id = Auth::id()) {
            $list = Cart::where('user_id', $id)->get();
            $count = 0;
            if ($list) {
                foreach ($list as $item) {
                    $count += $item->quantity;
                }
            }
            return $count;
        } else {
            return 0;
        }
    }

    public static function getTotalPrice()
    {
        $list = Cart::where('user_id', Auth::id())->with('product')->get();
        $sum = 0;
        foreach ($list as $item) {
            $sum += number_format($item->quantity, 2)*$item->product->price; 
        }
        return $sum;
    }

    public static function getCart()
    {
        $id = Auth::id();
        $list_cart = Cart::where('user_id', $id)->with('product')->get();
        if ($list_cart) {
            return $list_cart;
        } else {
            return '';
        }
    }
}
