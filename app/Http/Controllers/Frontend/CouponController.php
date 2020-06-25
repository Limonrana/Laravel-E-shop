<?php

namespace App\Http\Controllers\Frontend;

use Cart;
use App\Http\Controllers\Controller;
use App\Models\Admin\Coupon;
use Session;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Add coupon in checkout page.
     *
     * @param  //Request  $request
     * @return //Response
     */
    public function Coupon(Request $request)
    {
        $coupon = $request->coupon_code;
        $check  = Coupon::where('coupon_code', $coupon)->first();
        if ($check) {
            session()->put('coupon', [
                'name'          => $check->coupon_name,
                'code'          => $check->coupon_code,
                'discount'      => $check->discount,
                'last_balance'  => (Cart::subtotal() - $check->discount),
            ]);
            $notification = array(
                'messege' => 'Coupon successfully applied',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }
        else {
            $notification = array(
                'messege' => 'Invalid Your Coupon',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    /**
     * Remove coupon from checkout page.
     *
     * @param  //session
     * @return //delete
     */
    public function Remove()
    {
        Session::forget('coupon');
        $notification = array(
            'messege' => 'Coupon successfully removed',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
