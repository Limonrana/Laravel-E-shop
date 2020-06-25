<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'product_id',
    ];

    /**
     * This Model relationship with Category Model.
     *
     * @function belongsTo
     */
    public function get_product()
    {
        return $this->belongsTo('App\Models\Admin\Product', 'product_id');
    }
}
