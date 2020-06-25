<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application ecommerce dashboard.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */
     public function show()
     {
         $today = date('d-m-Y');
         $month = date('m');
         $year  = date('Y');
         $week_date = Carbon::today()->subDays(7);
         $user_date = Carbon::today()->subDays(30);

         $sale['today_amount']          = Order::where('date', $today)->where('refund', 0)->sum('order_amount');
         $sale['today_order']           = Order::where('date', $today)->where('refund', 0)->get();
         $sale['weekly_amount']         = Order::where('created_at', '>=', $week_date)->where('refund', 0)->sum('order_amount');
         $sale['weekly_order']          = Order::where('created_at', '>=', $week_date)->where('refund', 0)->get();
         $sale['monthly_amount']        = Order::where('month', $month)->where('refund', 0)->sum('order_amount');
         $sale['monthly_order']         = Order::where('month', $month)->where('refund', 0)->get();
         $sale['year_amount']           = Order::where('year', $year)->where('refund', 0)->sum('order_amount');
         $sale['year_order']            = Order::where('year', $year)->where('refund', 0)->get();
         $sale['new_user']              = User::where('created_at','>=',$user_date)->get();
         $sale['refund']                = Order::where('month', $month)->where('refund', 1)->sum('order_amount');
         $sale['order']                 = Order::paginate(5);
         return view('admin.pages.ecommerce.dashboard')->with($sale);
     }
}
