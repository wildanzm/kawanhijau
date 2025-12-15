<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'petani_profile_id',
        'category_id',
        'name',
        'description',
        'price',
        'unit',
        'stock',
        'image_path',
        'is_active'
    ];

    public function petaniProfile()
    {
        return $this->belongsTo(PetaniProfile::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
