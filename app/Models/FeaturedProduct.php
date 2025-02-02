<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedProduct extends Model
{
    protected $fillable = [
        'product_id',
        'display_order',
        'featured_image_path'
    ];

    /**
     * Get the product that is featured.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Ensure display order is within bounds
     */
    protected static function boot()
    {
        parent::boot();
        
        static::saving(function ($model) {
            if ($model->display_order < 1 || $model->display_order > 3) {
                throw new \Exception('Display order must be between 1 and 3');
            }
        });
    }
}