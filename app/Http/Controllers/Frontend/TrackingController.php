<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
use App\User;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    /**
     * tracking order for customer.
     *
     * @param //Request  $request
     * @return //Response
     */
    public function tracking(Request $request)
    {
        $email          = $request->email;
        $track_id       = $request->tracking_id;
        $user_check     = User::where('email', $email)->first();
        $order_check    = Order::where('tracking_number', $track_id)->first();
        if (!$user_check) {
            $notification = array(
                'messege' => 'Email Id Invalid',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
        elseif (!$order_check) {
            $notification = array(
                'messege' => 'Tracking Id Invalid',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
        else {
            return view('pages.tracking', compact('order_check', 'user_check'));
        }
    }
}
