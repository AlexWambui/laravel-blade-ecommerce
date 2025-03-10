<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Sale extends Model
{
    protected $fillable = [
        'order_number',
        'order_type',
        'discount_code',
        'discount',
        'total_amount',
        'amount_paid',
        'payment_method',
        'user_id',
    ];

    const ORDERTYPE = [
        0 => "online",
        1 => "shop",
    ];

    public function items()
    {
        return $this->hasMany(SaleItem::class, 'order_id');
    }
    
    public function delivery()
    {
        return $this->hasOne(SaleDelivery::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
