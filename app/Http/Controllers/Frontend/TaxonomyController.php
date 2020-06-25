<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\Subcategory;
use Illuminate\Http\Request;

class TaxonomyController extends Controller
{
    /**
     * Show the application product taxonomy page.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */
    public function Category($name, $id)
    {
        $title = $name;
        $product        = Product::where('status', 1)->where('category_id', $id)->paginate(20);
        $count          = Product::where('status', 1)->where('category_id', $id)->get();
        $category       = Category::orderBy('category_name', 'asc')->take(10)->get();
        $brand          = Brand::orderBy('brand_name', 'asc')->get();
        return view('pages.taxonomy', compact('product', 'category', 'brand', 'count', 'title'));
    }

    /**
     * Show the application product taxonomy page.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */
    public function SubCategory($name, $id)
    {
        $title = $name;
        $subcategory    = Subcategory::where('id', $id)->first();
        $category       = Category::where('id', $subcategory->categoty_id)->first();
        $product        = Product::where('status', 1)->where('subcategory_id', $id)->paginate(20);
        $count          = Product::where('status', 1)->where('subcategory_id', $id)->get();
        return view('pages.taxonomy', compact('product', 'subcategory', 'count', 'title'));
    }

    /**
     * Show the application product taxonomy page.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */
    public function Brand($name, $id)
    {
        $title = $name;
        $product        = Product::where('status', 1)->where('brand_id', $id)->paginate(20);
        $count          = Product::where('status', 1)->where('brand_id', $id)->get();
        $category       = Category::orderBy('category_name', 'asc')->take(10)->get();
        $brand          = Brand::orderBy('brand_name', 'asc')->get();
        return view('pages.taxonomy', compact('product', 'category', 'brand', 'count', 'title'));
    }
}
