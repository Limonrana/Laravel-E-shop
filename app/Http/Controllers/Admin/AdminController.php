<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
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
     * Show the application new orders.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $order = Order::where('status', 0)->where('refund', 0)->orwhere('status', 1)->orwhere('status', 2)->paginate(10);
        return view('admin.dashboard', compact('order'));
    }

    /**
     * Logout the application dashboard.
     */
    public function logout()
    {
        Auth::logout();
        $notification=array(
            'messege'=>'Successfully Logout',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.login.form')->with($notification);
    }
}
