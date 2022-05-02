<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\OrderProduct;
use App\Models\Rating;
use App\Models\Image;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'code',
        'price',
        'quantity',
        'cpu',
        'ram',
        'description',
        'rating',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders_products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'relation_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function getProductById($id)
    {
       return Product::find($id);
    }

    public function countProductsByCategory($category_id)
    {
        return Product::where('category_id', $category_id)->count();
    }

    public function countRatingByProductId($product_id)
    {
        return Rating::where('product_id', $product_id)->count();
    }
    public function setRating($product_id)
    {
        $rating = Rating::where('product_id', $product_id)->pluck('rating')->avg();
        $product = Product::find($product_id);
        if (isset($rating)) {
            $product->update(['rating' => $rating]);

            return $rating;
        } else {
            return $product->rating;
        }
    }
}
