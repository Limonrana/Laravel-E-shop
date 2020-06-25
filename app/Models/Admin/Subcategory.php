<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'subcategory_name'
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
}
