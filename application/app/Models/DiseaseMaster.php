<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiseaseMaster extends Model
{
    protected $fillable = [
        'name',
        'description',
        'symptoms',
        'treatment_recommendation'
    ];
}
