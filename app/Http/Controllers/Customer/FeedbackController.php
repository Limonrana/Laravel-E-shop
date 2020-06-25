<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
use App\Models\Admin\OrderDetail;
use App\Models\Admin\Product;
use App\Models\Frontend\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
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
     * Show the application Pending Feedback Product.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */

    public function Pending()
    {
        $pending = OrderDetail::where('user_id', Auth::user()->id)->where('review', 0)->get();
        return view('customer-dashboard.pending-feedback', compact('pending'));
    }

    public function SingleProduct($slug, $ord_id, $ran)
    {
        $single_product = Product::where('slug', $slug)->first();

        $color          = $single_product->product_color;
        $single_color   = explode(',', $color);

        $size           = $single_product->product_size;
        $single_size    = explode(',', $size);

        $capacity       = $single_product->product_capacity;
        $single_cap     = explode(',', $capacity);
        $featured       = Product::orderBy('product_name', 'asc')->where('status', 1)->where('discount_price', NULL)->take(3)->get();
        $featured2      = Product::orderBy('product_name', 'desc')->where('status', 1)->where('discount_price', NULL)->take(3)->get();
        $main_featured  = Product::orderBy('product_name', 'desc')->where('status', 1)->take(5)->get();

        $recent_view    = Product::where('status', 1)->limit(12)->get();

        return view('pages.single-product', compact('single_product', 'single_color', 'single_size', 'single_cap', 'recent_view', 'featured', 'featured2', 'main_featured', 'ord_id'));
    }
}
