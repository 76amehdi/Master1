<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'unit',
        'price',
        'discount_price',
    ];

    /**
     * Get the product that owns the product unit.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function purchasedetails()
    {
        return $this->hasMany(ProductUnit::class);

    }

}
