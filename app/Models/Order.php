<?php

namespace App\Models;

use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'tracking_id',
        'delivery_status',
        'payment_status',
        'delivery_country',
        'delivery_firstname',
        'delivery_lastname',
        'delivery_company',
        'delivery_address',
        'delivery_apartment',
        'delivery_postcode',
        'delivery_city',
        'delivery_phone',
        'delivery_save_data',
        'delivery_sms_offers',
        'billing_country',
        'billing_firstname',
        'billing_lastname',
        'billing_company',
        'billing_address',
        'billing_apartment',
        'billing_postcode',
        'billing_city',
        'billing_phone',
        'payment',
        'contact_email_or_phone',
        'contact_newsletter',
    ];

    /**
     * Relationship: An order can have many order details (products).
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

   
}

