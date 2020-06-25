<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Illuminate\Http\Request;

class ShopPageController extends Controller
{

    /**
     * Show the application product frontend.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product        = Product::latest()->where('status', 1)->paginate(12);
        $featured       = Product::orderBy('id', 'asc')->where('status', 1)->where('discount_price', NULL)->where('category_id', 19)->limit(3)->get();
        $featured2      = Product::orderBy('id', 'desc')->where('status', 1)->where('discount_price', NULL)->where('category_id', 19)->limit(3)->get();
        $count          = Product::where('status', 1)->get();
        $category       = Category::orderBy('category_name', 'asc')->take(10)->get();
        $brand          = Brand::orderBy('brand_name', 'asc')->get();
        return view('pages.shop', compact('product', 'category', 'brand', 'count', 'featured', 'featured2'));
    }
}
