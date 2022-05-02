<?php
namespace App\Helpers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Role;
use App\Models\Category;
use App\Models\Product;
use App\Models\Image;
use App\Models\Cart;
use App\Defines\Define;
use Auth;

class Custom
{
    public static function getDateNow()
    {
        return Carbon::now()->toDateString();
    }
    
    public static function getRoles()
    {
        return Role::get();
    }

    public function getCategoryNamebyId($id)
    {
        return Category::where('id', $id)->get('name');
        // dd($category);
        // $name = $catgory->name;

        // return $name;
    }

    public static function getCategories()
    {
        return Category::get();
    }

    public static function formatToDate($time)
    {
        return Carbon::createFromFormat('m/d/Y', $time);
    }

    public static function getPathImageByProductId($id)
    {
        $image = Image::where('relation_id', $id)->where('type', 'products')->first();
        if ($image) {
            return $image->path;
        } else {
            return 'image/no-image.png';
        }
    }

    public static function getPathImagesByProductId($id)
    {
        $paths =  Image::where('relation_id', $id)->get('path');
        if ($paths) {
            return $paths;
        } else {
            return 'image/no-image.png';
        }
    }

    public static function getcountCart()
    {
        if (Auth::user()) {
            return Cart::getCountCartList();
        } else {
            return 0;
        }
    }

    public static function getTotalPriceCart()
    {
        if (Auth::user()) {
            return Cart::getTotalPrice();
        } else {
            return 0;
        }
    }

    public static function getCartList()
    {
        if (Auth::user()) {
            return Cart::getCart();
        } else {
            return '';
        }
    }

    public static function multiplyPrice ($num1, $num2)
    {
        return (double)$num1 * (double)$num2;
    }

    public static function getAllStatusOrder()
    {
        return [
            // [
            //     'value' => -1,
            //     'content' => __('Default'),
            // ],
            [
                'value' => Define::WAITING,
                'content' => __('Waiting confirm'),
            ],
            [
                'value' => Define::CONFIRM,
                'content' => __('Confirmed'),
            ],
            [
                'value' => Define::SHIPPING,
                'content' => __('Shipping'),
            ],
            [
                'value' => Define::FINISH,
                'content' => __('Finish'),
            ],
            [
                'value' => Define::CANCEL,
                'content' => __('Cancel'),
            ],
        ];
    }

    public static function getFilterRam()
    {
        return [2, 4, 8, 16, 32, 64];
    }

    public static function getFilterPrice()
    {
        return [
            [
                'min' => 0,
                'max' => 1000,
                'content' => __('$0 - $1000'),
            ],
            [
                'min' => 1000,
                'max' => 2000,
                'content' => __(' $1000 - $2000'),
            ],
            [
                'min' => 2000,
                'max' => 3000,
                'content' => __('$2000 - $3000'),
            ],
            [
                'min' => 3000,
                'max' => 4000,
                'content' => __(' $3000 - $4000'),
            ],
            [
                'min' => 4000,
                'max' => -1,
                'content' => __('$4000 +'),
            ],
        ];
    }
}
