<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Admin\ShippingMethod;
use Illuminate\Http\Request;

class ShippingController extends Controller
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
     * Show the application product.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        $ship_class = ShippingMethod::paginate(10);
        return view('admin.pages.shipping.shipping', compact('ship_class'));
    }

    /**
     * Store a new shipping method.
     *
     * @param  //Request  $request
     * @return //Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'shipping_title' => 'required|unique:shipping_methods|max:85',
            'shipping_type' => 'required|max:55',
            'shipping_time' => 'required|max:120',
        ]);

        $shipping = new ShippingMethod();
        $shipping->shipping_title = $request->shipping_title;
        $shipping->shipping_type = $request->shipping_type;
        $shipping->shipping_charge = $request->shipping_charge;
        $shipping->shipping_time = $request->shipping_time;
        $shipping->status = 1;

        $shipping->save();
        $notification = array(
            'messege' => 'Shipping method successfully added',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.shipping')->with($notification);
    }


    /**
     * Edit existing shipping method.
     *
     * @param  //id
     * @return //view
     */

    public function edit($id)
    {
        $ship_method = ShippingMethod::findOrFail($id);
        return view('admin.pages.shipping.edit-shipping', compact('ship_method'));
    }

    /**
     * Update existing shipping method.
     *
     * @param  //Request  $request $id
     * @return //Response
     */
    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'shipping_title'    => 'required|max:85',
            'shipping_type'     => 'required|max:55',
            'shipping_time'     => 'required|max:120',
        ]);

        $shipping = ShippingMethod::find($id);
        $shipping->shipping_title = $request->shipping_title;
        $shipping->shipping_type = $request->shipping_type;
        $shipping->shipping_charge = $request->shipping_charge;
        $shipping->shipping_time = $request->shipping_time;

        $shipping->save();
        $notification = array(
            'messege' => 'Shipping method successfully updated',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.shipping')->with($notification);
    }


    /**
     * Delete existing shipping method.
     *
     * @param  //id
     * @return //view
     */
    public function delete($id)
    {
        $shipping = ShippingMethod::find($id);
        $shipping->forceDelete();
        $notification = array(
            'messege' => 'Shipping method successfully deleted',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.shipping')->with($notification);
    }

    /**
     * Active existing shipping method.
     *
     * @param  //id
     * @return //active
     */
    public function Active($id)
    {
//        $all_shipping = ShippingMethod::where('status', 1)->get();
//        if ($all_shipping) {
//            foreach ($all_shipping as $val ) {
//                $val->status = 0;
//                $val->save();
//            }
//        }
        $shipping = ShippingMethod::find($id);
        $shipping->status = 1;
        $shipping->save();
        $notification = array(
            'messege' => 'Shipping method successfully activated',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    /**
     * Inactive existing shipping method.
     *
     * @param  //id
     * @return //active
     */
    public function Inactive($id)
    {
        $shipping = ShippingMethod::find($id);
        $shipping->status = 0;
        $shipping->save();
        $notification = array(
            'messege' => 'Shipping method successfully deactivated',
            'alert-type' => 'warning'
        );
        return back()->with($notification);
    }
}
