<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'coupon_name', 'coupon_code', 'discount'
    ];
}
