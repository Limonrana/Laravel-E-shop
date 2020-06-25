<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Postcategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_name_en', 'category_name_bn'
    ];
}
