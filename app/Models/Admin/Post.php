<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_title_en', 'post_title_bn', 'category_id', 'subcategory_id', 'tag_id', 'slug', 'post_description_en', 'post_description_bn',
        'video_link', 'featured_image', 'status'
    ];

    /**
     * The attributes that are mass array
     *
     * @var array
     */

    protected $casts = [
        'subcategory_id' => 'array',
        'tag_id'         => 'array',
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

    /**
     * This Model relationship with Tags Model.
     *
     * @function belongsTo
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Admin\Posttag', 'tag_posts')->withTimestamps();
    }
}
