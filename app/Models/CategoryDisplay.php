<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryDisplay extends Model
{
    protected $table = 'category_display';
    protected $fillable = [
        'category_id',
        'display_image_path',
        'display_order'
    ];

    /**
     * Get the category being displayed.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Ensure display order is within bounds
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->display_order < 1 || $model->display_order > 4) {
                throw new \Exception('Display order must be between 1 and 4');
            }
        });
    }
}
