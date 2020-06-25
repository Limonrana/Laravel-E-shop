<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Illuminate\Http\Request;

class StockManageController extends Controller
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
     * Show the application product stock.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */
    public function ShowAll()
    {
        $product = Product::orderBy('product_quantity', 'asc')->where('status', 1)->where('product_quantity', '!=', 0)->paginate(10);
        return view('admin.pages.stock-manage.all-stock-products', compact('product'));
    }

    /**
     * Show the application product low stock.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */
    public function ShowLowStock()
    {
        $product = Product::orderBy('product_quantity', 'asc')->where('status', 1)->where('product_quantity', '<=', 5)->where('product_quantity', '!=', 0)->paginate(10);
        return view('admin.pages.stock-manage.low-stock', compact('product'));
    }

    /**
     * Show the application product out of stock.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */
    public function ShowOutStock()
    {
        $product = Product::orderBy('product_quantity', 'asc')->where('status', 1)->where('product_quantity', '=', 0)->paginate(10);
        return view('admin.pages.stock-manage.out-stock', compact('product'));
    }
}
