<?php

namespace App\Models\Deliveries;

use Illuminate\Database\Eloquent\Model;

class DeliveryLocation extends Model
{
    protected $fillable = [
        'name',
    ];

    public function areas()
    {
        return $this->hasMany(DeliveryArea::class, 'delivery_location_id');
    }
}
