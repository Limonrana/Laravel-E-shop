<?php

namespace App\Http\Controllers\Frontend;

use App\Mail\InvoiceMail;
use App\Models\Admin\Order;
use App\Models\Admin\OrderDetail;
use App\Models\Admin\Product;
use App\Models\Admin\ShippingMethod;
use App\Models\Frontend\Country;
use App\Models\Frontend\State;
use Cart;
use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Session;

class CheckoutController extends Controller
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
     * Show the application checkout.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        $cart       = Cart::Content();
        $shipping   = ShippingMethod::where('status', 1)->get();
        $country    = Country::all();
        return view('pages/checkout', compact('cart', 'shipping', 'country'));
    }

    /**
     * Get the application State And City Via Ajax.
     *
     *@param //$id
     * @return //View
     */
    public function State($id)
    {
        $state = State::where('country_id', $id)->get();
        return response()->json($state);
    }

    public function City($id)
    {
        $city = City::where('state_id', $id)->get();
        return response()->json($city);
    }

    /**
     * Create a new order data store on session.
     *
     * @param  //Request  $request
     * @return //Response
     */

    public function Order(Request $request)
    {
        $shipping_charge = ShippingMethod::where('status', 1)->where('id', $request->shipping)->first();
        $charge = $shipping_charge->shipping_charge;
        $user_id = Auth::id();
        $subtotal = Cart::Subtotal();
        if (Session::has('coupon')) {
            $discount = Cart::Subtotal() - session()->get('coupon')['discount'];
            $total = $discount + $charge;
        } else {
            $total = $subtotal + $charge;
        }

        session()->put('order', [
            'user_id'           => $user_id,
            'shipping'          => $request->shipping,
            'total'             => $total,
            'ship_name'         => $request->ship_name,
            'ship_email'        => $request->ship_email,
            'ship_phone'        => $request->ship_phone,
            'ship_address'      => $request->ship_address,
            'ship_address_2'    => $request->ship_address_2,
            'ship_city'         => $request->ship_city,
            'ship_state'        => $request->ship_state,
            'ship_zip'          => $request->ship_zip,
            'ship_country'      => $request->ship_country,
        ]);

        return redirect()->route('order.payment.page');

    }

    /**
     * Payment Form Show.
     *
     * @return //view
     */

    public function PaymentShow()
    {
        $cart       = Cart::Content();
        return view('pages.checkout-review', compact('cart'));
    }

    /**
     * Create a new order store adn payment.
     *
     * @param  //Request  $request
     * @return //Response
     */

    public function Payment(Request $request)
    {
        $email = Auth::user()->email;
        $shipping_id = session()->get('order')['shipping'];
        $shipping_charge = ShippingMethod::where('status', 1)->where('id', $shipping_id)->first();
        $charge = $shipping_charge->shipping_charge;
        $user_id = Auth::id();
        $subtotal = Cart::Subtotal();
        if (Session::has('coupon')) {
            $discount = Cart::Subtotal() - session()->get('coupon')['discount'];
            $total = $discount + $charge;
        } else {
            $total = $subtotal + $charge;
        }

        if ($request->payment_type == 'stripe') {
            \Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));
            $stripe_payment = \Stripe\Charge::create ([
                "amount" => $total * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Product payment from E-shop",
                "metadata"  => ['order_id' => Str::random(15)],
            ]);
        }
        elseif ($request->payment_type == '2Checkout') {
            echo 'Ideal';
        }
        else {
            echo 'paypal';
        }

        if (Session::has('order')) {
            $order = new Order();
            $order->user_id = $user_id;
            $order->payment_id = $stripe_payment->payment_method;
            $order->transaction_id = $stripe_payment->balance_transaction;
            $order->payment_type = $request->payment_type;
            $order->method_order_id = 'ES-' . mt_rand(100000, 999999);;
            $order->order_amount = $total;
            $order->shipping = $shipping_id;
            $order->tracking_number = 'ES-' . Str::random(10);
            $order->ship_name = session()->get('order')['ship_name'];
            $order->ship_email = session()->get('order')['ship_email'];
            $order->ship_phone = session()->get('order')['ship_phone'];
            $order->ship_address = session()->get('order')['ship_address'];
            $order->ship_address_2 = session()->get('order')['ship_address_2'];
            $order->ship_city = session()->get('order')['ship_city'];
            $order->ship_state = session()->get('order')['ship_state'];
            $order->ship_zip = session()->get('order')['ship_zip'];
            $order->ship_country = session()->get('order')['ship_country'];
            $order->status = 0;
            $order->month = date("m");
            $order->date = date("d-m-Y");
            $order->year = date("Y");
            $order->save();

            $product_cart = Cart::Content();
            foreach ($product_cart as $val) {
                $details = new OrderDetail();
                $details->order_id = $order->id;
                $details->product_id = $val->id;
                $details->product_name = $val->name;
                $details->product_code = $val->options->code;
                $details->color = $val->options->color;
                $details->size = $val->options->size;
                $details->capacity = $val->options->capacity;
                $details->quantity = $val->qty;
                //$details->image = $val->options->image;
                $details->price = $val->price;
                $details->total_price = $val->price * $val->qty;
                $details->save();
            }
            $data ['order']     = $order;
            $data ['details']   = $details;

            //Mail Send
            Mail::to($email)->send(new InvoiceMail($data));

            Cart::destroy();
            if (Session::has('coupon')) {
                Session::forget('coupon');
            }
            if (Session::has('order')) {
                Session::forget('order');
            }
        } else {
            $notification = array(
                'messege' => 'Shipping details not found, Please submit again!',
                'alert-type' => 'error'
            );
            return redirect()->route('order.payment')->with($notification);
        }

        $notification = array(
            'messege' => 'Order successfully completed!',
            'alert-type' => 'success'
        );
        return redirect()->route('order.confirm.page')->with($notification);
    }


    /**
     * Show the application Order Confirm Page.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */

    public function Confirm()
    {
        $order = Order::where('user_id', Auth::user()->id)->latest()->first();
        return view('pages.order-confirm', compact('order'));
    }
}
