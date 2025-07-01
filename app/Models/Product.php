<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model

{protected $fillable = [
    'title',
    'parent_id',
    'category_id',
    'badge_id',
    'price',
    'thumb_images_url',
    'image_urls' => 'array',
    'description',
    'stock',
    'status',
    'is_variant',
    'size',
    'color',
    'specifications',
];
    public function Order(){
        return $this->belongsto(order::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function badge()
    {
        return $this->belongsTo(Badge::class);
    }
    public function cart()
{
    return $this->hasMany(Cart::class);
}

}
