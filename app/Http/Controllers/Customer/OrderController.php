<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application new order.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */

    public function NewOrder()
    {
        $all            = Order::where('user_id', Auth::user()->id)->count('id');
        $new            = Order::where('user_id', Auth::user()->id)->where('status', 0)->count('status');
        $progressing    = Order::where('user_id', Auth::user()->id)->where('status', 1)->count('status');
        $complete       = Order::where('user_id', Auth::user()->id)->where('status', 2)->count('status');
        $new_orders     = Order::where('user_id', Auth::user()->id)->where(function ($q) { $q->where('status', 1)->orWhere('status', 0)->orWhere('status', 2);})->paginate(5);
        return view('customer-dashboard.new-orders', compact('all','new', 'progressing', 'complete', 'new_orders'));
    }


    /**
     * Show the application complete order.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */

    public function CompleteOrder()
    {
        $all            = Order::where('user_id', Auth::id())->count('id');
        $new            = Order::where('user_id', Auth::id())->where('status', 0)->count('status');
        $progressing    = Order::where('user_id', Auth::id())->where('status', 1)->count('status');
        $complete       = Order::where('user_id', Auth::id())->where('status', 2)->count('status');
        $complete_orders     = Order::where('user_id', Auth::id())->where('status', 3)->paginate(5);
        return view('customer-dashboard.complete-orders', compact('all','new', 'progressing', 'complete', 'complete_orders'));
    }

}
