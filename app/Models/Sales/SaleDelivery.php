<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Model;

class SaleDelivery extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'address',
        'location',
        'area',
        'shipping_cost',
        'delivery_status',
        'order_id',
    ];

    const DELIVERYSTATUS = [
        'pending',
        'delivered',
    ];

    const PAYMENTMETHODS = [
        'Cash',
        'MPesa',
        'Bank Transfer',
    ];

    public function getFormattedPhoneNumberAttribute()
    {
        // Ensure phone_number exists to avoid errors
        if (!$this->phone_number) {
            return null;
        }

        // Remove any non-digit characters
        $number = preg_replace('/\D/', '', $this->phone_number);

        // Format the number with spaces after every three digits
        return preg_replace('/(\d{3})(?=\d)/', '$1 ', $number);
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'order_id');
    }
}
