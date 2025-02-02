<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageSetting extends Model
{
    protected $fillable = [
        'currency',
        'normal_delivery_price',
        'free_delivery_threshold'
    ];

    protected $casts = [
        'normal_delivery_price' => 'decimal:2',
        'free_delivery_threshold' => 'decimal:2'
    ];
}