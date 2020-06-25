<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name', 'category_id', 'subcategory_id', 'brand_id', 'product_code', 'slug', 'product_quantity', 'product_description',
        'product_color', 'product_size', 'selling_price', 'discount_price', 'video_link', 'header_slider', 'hot_deal', 'best_rated', 'mid_slider',
        'hot_new', 'trend', 'featured_image', 'gallery_image_1', 'gallery_image_2', 'status'
    ];

    /**
     * This Model relationship with Category Model.
     *
     * @function belongsTo
     */
    public function get_category()
    {
        return $this->belongsTo('App\Models\Admin\Category', 'category_id');
    }

    /**
     * This Model relationship with Category Model.
     *
     * @function belongsTo
     */
    public function get_subcategory()
    {
        return $this->belongsTo('App\Models\Admin\Subcategory', 'subcategory_id');
    }

    /**
     * This Model relationship with Brand Model.
     *
     * @function belongsTo
     */
    public function get_brand()
    {
        return $this->belongsTo('App\Models\Admin\Brand', 'brand_id');
    }
}
