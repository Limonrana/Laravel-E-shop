<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
use App\Models\Admin\OrderDetail;
use App\Models\Admin\Product;
use App\Models\Admin\ShippingMethod;
use App\Models\Frontend\City;
use App\Models\Frontend\Country;
use App\Models\Frontend\State;
use Illuminate\Http\Request;

class OrderController extends Controller
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
     * Show the application All orders.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */

    public function AllOrders()
    {
        $order = Order::paginate(10);
        return view('admin.pages.ecommerce.all-orders', compact('order'));
    }

    /**
     * Show the application new orders.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */

    public function NewOrders()
    {
        $order = Order::where('status', 0)->where('refund', 0)->orwhere('status', 1)->paginate(10);
        return view('admin.pages.order.new-orders', compact('order'));
    }

    /**
     * Show the application pending orders.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */

    public function PendingOrders()
    {
        $order = Order::where('status', 0)->where('refund', 0)->paginate(10);
        return view('admin.pages.order.pending-orders', compact('order'));
    }

    /**
     * Show the application confirm orders.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */

    public function ConfirmOrders()
    {
        $order = Order::where('status', 1)->where('refund', 0)->paginate(10);
        return view('admin.pages.order.confirm-orders', compact('order'));
    }

    /**
     * Show the application Processing orders.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */

    public function ProcessingOrders()
    {
        $order = Order::where('status', 2)->where('refund', 0)->paginate(10);
        return view('admin.pages.order.processing-orders', compact('order'));
    }

    /**
     * Show the application Complete orders.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */

    public function CompleteOrders()
    {
        $order = Order::where('status', 3)->where('refund', 0)->paginate(10);
        return view('admin.pages.order.complete-orders', compact('order'));
    }

    /**
     * Show the application Cancel orders.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */

    public function HoldOrders()
    {
        $order = Order::where('status', 4)->where('refund', 0)->paginate(10);
        return view('admin.pages.order.hold-orders', compact('order'));
    }


    /**
     * Edit existing order.
     *
     * @param  //id
     * @return //view
     */

    public function EditOrder($id)
    {
        $product        = OrderDetail::where('order_id', $id)->paginate(5);
        $order_details  = Order::where('id', $id)->first();
        $state          = State::where('id', $order_details->ship_state)->first();
        $shipping_d     = ShippingMethod::where('id', $order_details->shipping)->first();
        $country        = Country::where('id', $order_details->ship_country)->first();
        return view('admin.pages.order.edit-order', compact('product', 'order_details', 'state', 'shipping_d', 'country'));
    }

    /**
     * Confirm existing order.
     *
     * @param  //id
     * @return //view
     */

    public function ConfirmOrder($id)
    {
        $order = Order::find($id);
        $order->status = 1;
        $order->save();
        $order_details = OrderDetail::where('order_id', $id)->get();
        foreach ($order_details as $val) {
           $product = Product::find($val->product_id);
           $product->product_quantity = $product->product_quantity - $val->quantity;
           $product->save();
        }
        $notification = array(
            'messege' => 'Order payment successfully accept',
            'alert-type' => 'success'
        );
        return redirect(route('admin.confirm.orders'))->with($notification);
    }

    /**
     * Processing existing order.
     *
     * @param  //id
     * @return //view
     */

    public function ProcessingOrder($id)
    {
        $order = Order::find($id);
        $order->status = 2;
        $order->save();
        $notification = array(
            'messege' => 'Order successfully Processing Done',
            'alert-type' => 'success'
        );
        return redirect(route('admin.processing.orders'))->with($notification);
    }

    /**
     * Complete existing order.
     *
     * @param  //id
     * @return //view
     */

    public function CompleteOrder($id)
    {
        $order = Order::find($id);
        $order->status = 3;
        $order->save();
        $notification = array(
            'messege' => 'Order successfully Completed',
            'alert-type' => 'success'
        );
        return redirect(route('admin.complete.orders'))->with($notification);
    }

    /**
     * Cancel a new order.
     *
     * @param  //id
     * @return //view
     */

    public function HoldOrder($id)
    {
        $order = Order::find($id);
        $order->status = 4;
        $order->save();
        $order_details = OrderDetail::where('order_id', $id)->get();
        foreach ($order_details as $val) {
            $product = Product::find($val->product_id);
            $product->product_quantity = $product->product_quantity + $val->quantity;
            $product->save();
        }
        $notification = array(
            'messege' => 'Order successfully canceled',
            'alert-type' => 'error'
        );
        return redirect(route('admin.hold.orders'))->with($notification);
    }


    /**
     * Delete existing product.
     *
     * @param  //id
     * @return //view
     */

    public function DeleteOrder($id)
    {
        $order = Order::find($id);
        $order->forceDelete();
        $details = OrderDetail::where('order_id', $id)->get();
        foreach ($details as $val) {
            $val->forceDelete();
        }
        $notification = array(
            'messege' => 'Order data successfully deleted',
            'alert-type' => 'error'
        );
        return back()->with($notification);
    }

}
