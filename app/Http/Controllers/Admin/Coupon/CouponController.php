<?php

namespace App\Http\Controllers\Admin\Coupon;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
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
     * Show the application category.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $coupon = Coupon::paginate(10);
        return view('admin.pages.coupon.coupon', compact('coupon'));
    }

    /**
     * Store a new category.
     *
     * @param  //Request  $request
     * @return //Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'coupon_name' => 'required|unique:coupons|max:35',
            'coupon_code' => 'required|unique:coupons|max:20',
            'discount' => 'required|unique:coupons|max:5',
        ]);

        $coupon = new Coupon();
        $coupon->coupon_name = $request->coupon_name;
        $coupon->coupon_code = $request->coupon_code;
        $coupon->discount    = $request->discount;
        $coupon->save();
        $notification=array(
            'messege'=>'Coupon successfully added',
            'alert-type'=>'success'
        );
        return redirect()->route('admin.coupon')->with($notification);
    }

    /**
     * Edit existing category.
     *
     * @param  //id
     * @return //view
     */

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.pages.coupon.edit-coupon', compact('coupon'));
    }

    /**
     * Edit existing category.
     *
     * @param  //id
     * @return //view
     */
    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'coupon_name' => 'required|max:35',
            'coupon_code' => 'required|max:20',
            'discount' => 'required|max:5',
        ]);

        $coupon = new Coupon();
        $coupon->coupon_name = $request->coupon_name;
        $coupon->coupon_code = $request->coupon_code;
        $coupon->discount    = $request->discount;
        $coupon->save();
        $notification=array(
            'messege'=>'Coupon successfully updated',
            'alert-type'=>'success'
        );
        return redirect()->route('admin.coupon')->with($notification);
    }

    /**
     * Delete existing category.
     *
     * @param  //id
     * @return //view
     */
    public function delete($id)
    {
        $coupon = Coupon::find($id);
        $coupon->forceDelete();
        $notification=array(
            'messege'=>'Coupon successfully deleted',
            'alert-type'=>'error'
        );
        return redirect()->route('admin.coupon')->with($notification);
    }
}
