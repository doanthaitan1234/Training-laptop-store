<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderProduct;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'user_id',
        'total_price',
        'address',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function orders_products()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
