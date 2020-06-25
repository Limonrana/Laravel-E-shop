<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Postsubcategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'subcategory_name_en', 'subcategory_name_bn'
    ];

    /**
     * This Model relationship with Category Model.
     *
     * @function belongsTo
     */
    public function get_post_category()
    {
        return $this->belongsTo('App\Models\Admin\Postcategory', 'category_id');
    }
}
