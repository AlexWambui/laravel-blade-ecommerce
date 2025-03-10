<?php

namespace App\Models\Deliveries;

use Illuminate\Database\Eloquent\Model;

class DeliveryArea extends Model
{
    protected $fillable = [
        'name',
        'price',
        'delivery_location_id',
    ];

    public function delivery_location()
    {
        return $this->belongsTo(DeliveryLocation::class, 'delivery_location_id');
    }
}
