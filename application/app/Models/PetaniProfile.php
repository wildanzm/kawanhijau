<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetaniProfile extends Model
{
    protected $fillable = [
        'user_id',
        'farm_name',
        'address',
        'city',
        'phone_number',
        'verification_status',
        'bio',
        'farm_size',
        'farming_experience',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
