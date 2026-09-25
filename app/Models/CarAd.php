<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarAd extends Model
{
    protected $fillable = [
        'user_id', 'city', 'car_info', 'registered_in',
        'exterior_color', 'mileage', 'engine_type', 'vehicle_condition',
        'description', 'price', 'features', 'mobile_number',
        'secondary_number', 'whatsapp_enabled',
        'image_1', 'image_2', 'image_3', 'image_4', 'image_5'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}