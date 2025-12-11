<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetectionHistory extends Model
{
    protected $fillable = [
        'user_id',
        'image_path',
        'detected_disease_name',
        'confidence_score',
        'disease_master_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function diseaseMaster()
    {
        return $this->belongsTo(DiseaseMaster::class);
    }
}
