<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'qty',
        'brand',
        'category_id',
        'warehouse_id',
        'ingredient',
        'utilisation',
        'result',
        'colors', 
        'recuperation_from_shop',
    ];
    

    /**
     * Get the warehouse that owns the product.
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class); // Assuming Category model exists
    }

    /**
     * Get the product images for the product.
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Get the product units for the product.
     */
    public function units()
    {
        return $this->hasMany(ProductUnit::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id');
    }
}
