<?php

namespace App\Models\Admin;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'payment_id', 'payment_type', 'transaction_id', 'method_order_id', 'order_amount', 'shipping', 'ship_name', 'ship_email',
        'ship_phone', 'ship_address', 'ship_address_2', 'ship_city', 'ship_state', 'ship_zip', 'ship_country', 'status', 'tracking_number',
        'month', 'date', 'year',
    ];

    /**
     * This Model relationship with User Model.
     *
     * @function belongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * This Model relationship with User Model.
     *
     * @function belongsTo
     */
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    /**
     * This Model relationship with User Model.
     *
     * @function belongsTo
     */
    public function shipping_all()
    {
        return $this->belongsTo('App\Models\Admin\ShippingMethod', 'shipping');
    }

}
