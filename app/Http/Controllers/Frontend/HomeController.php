<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Home;
use App\Models\Admin\Post;
use App\Models\Admin\Product;
use App\Models\Admin\Slider;
use App\Models\Frontend\Wishlist;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application product home page.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $banner     = Product::latest()->where('header_slider', 1)->where('status', 1)->first();
        $featured   = Product::latest()->where('status', 1)->limit(8)->get();
        $phone      = Product::orderBy('id', 'desc')->where('category_id', 19)->where('status', 1)->limit(10)->get();
        $laptop     = Product::orderBy('id', 'desc')->where('category_id', 21)->where('status', 1)->limit(10)->get();
        $category   = Category::orderBy('category_name', 'asc')->limit(9)->get();
        $slider     = Slider::all();
        $home       = Home::where('id', 1)->first();

        return view('pages.index', compact('category','banner', 'featured', 'phone', 'laptop', 'slider', 'home'));
    }

    /**
     * Search Product from website.
     *
     * @param  //Request  $request
     * @return //Response
     */

    public function Search(Request $request)
    {
        $item = $request->search;
        $cat_id = $request->category;
        if ($item && $cat_id) {
            $product = Product::where('product_name', 'LIKE', "%{$item}%")->Where('category_id', $cat_id)->paginate(15);
            $count = Product::where('product_name', 'LIKE', "%{$item}%")->Where('category_id', $cat_id)->get();
        }
        else {
            $product = Product::where('product_name', 'LIKE', "%{$item}%")->paginate(15);
            $count = Product::where('product_name', 'LIKE', "%{$item}%")->get();
        }
        return view('pages.search', compact('product', 'count'));
    }


    public function QuickShow()
    {
        return view('pages.product-quick-view');
    }
}
