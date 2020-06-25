<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Posttag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_name_en', 'brand_name_bn'
    ];

    /**
     * This Model relationship with Tag Model.
     *
     * @function belongsTo
     */
    public function tags()
    {
        return $this->belongsTo(Posttag::class);
    }
}
