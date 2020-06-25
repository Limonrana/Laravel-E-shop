<?php

namespace App\Models\Frontend;

use App\Models\Admin\Product;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * This Model relationship with Product Model.
     *
     * @function belongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * This Model relationship with User Model.
     *
     * @function belongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
