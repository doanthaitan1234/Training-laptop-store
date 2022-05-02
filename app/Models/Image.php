<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'relation_id',
        'type',
        'path',
    ];

    public static function getImages($id)
    {
        return Image::where('relation_id', $id)->get();
    }

    
    
}
