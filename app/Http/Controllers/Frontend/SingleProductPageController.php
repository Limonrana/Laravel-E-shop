<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Frontend\Review;
use Illuminate\Http\Request;
use Response;

class SingleProductPageController extends Controller
{
    public function index()
    {
        return view('pages.single-product');
    }

    /**
     * Show the application product.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */

    public function view($slug, $ran)
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
        return view('pages.single-product', compact('single_product', 'single_color', 'single_size', 'single_cap', 'recent_view', 'featured', 'featured2', 'main_featured'));
    }

    /**
     * Quick-view the product via ajax.
     *
     * @return //product data
     */
    public function QuickView($id)
    {
        $single_product = Product::where('id', $id)->first();

        $color = $single_product->product_color;
        $single_color = explode(',', $color);

        $size = $single_product->product_size;
        $single_size = explode(',', $size);
        $capacity = $single_product->product_capacity;
        $single_cap = explode(',', $capacity);
//        return response()->json($single_product);
        return response::json(array(
            'product'   => $single_product,
            'color'   => $single_color,
            'size'   => $single_size,
            'capacity'   => $single_cap,
        ));
    }

}
