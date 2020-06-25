<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_id', 'posts', 'pages', 'comments', 'reviews', 'coupons', 'ecommerce', 'orders', 'products', 'stock_manage', 'theme_panel', 'mail', 'widgets', 'users', 'tools', 'settings', 'create_admin'
    ];
}
