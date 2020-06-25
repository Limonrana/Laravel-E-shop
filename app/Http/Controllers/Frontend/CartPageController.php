<?php

namespace App\Http\Controllers\Frontend;

use Cart;
use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;

class CartPageController extends Controller
{
    /**
     * Add to cart view page.
     *
     * @param  //cart::content
     * @return //view
     */
    public function index()
    {
        $cart = Cart::content();
        return view('pages.cart', compact('cart'));
    }

    /**
     * Add to cart a new single product.
     *
     * @param  //Request  $request
     * @return //Response
     */
    public function SingleCart($id)
    {
        $product = Product::where('id', $id)->first();
            if ($product->discount_price) {
                $data = array();
                $data['id'] = $product->id;
                $data['name'] = $product->product_name;
                $data['qty'] = 1;
                $data['price'] = $product->discount_price;
                $data['weight'] = 1;
                $data['options']['slug'] = $product->slug;
                $data['options']['code'] = $product->product_code;
                $data['options']['image'] = $product->featured_image;
                $data['options']['color'] = '';
                $data['options']['size'] = '';
                Cart::add($data);
                return response()->json(['success' => 'Successfully Added on your Cart']);
            } else {
                $data = array();
                $data['id'] = $product->id;
                $data['name'] = $product->product_name;
                $data['qty'] = 1;
                $data['price'] = $product->selling_price;
                $data['weight'] = 1;
                $data['options']['slug'] = $product->slug;
                $data['options']['code'] = $product->product_code;
                $data['options']['image'] = $product->featured_image;
                $data['options']['color'] = '';
                $data['options']['size'] = '';
                Cart::add($data);
                return response()->json(['success' => 'Successfully added on your Cart']);
            }
    }


    /**
     * Add to cart a new single product from Model.
     *
     * @param  //Request  $request
     * @return //Response
     */
    public function ModelCart(Request $request)
    {
        $id = $request->product_id;
        $product = Product::where('id', $id)->first();
        if ($product->discount_price) {
            $data = array();
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = $request->qty;
            $data['price'] = $product->discount_price;
            $data['weight'] = 1;
            $data['options']['slug'] = $product->slug;
            $data['options']['image'] = $product->featured_image;
            $data['options']['code'] = $product->product_code;
            $data['options']['color'] = $request->p_color;
            $data['options']['size'] = $request->p_size;
            $data['options']['capacity'] = $request->p_capacity;
            Cart::add($data);
            return response()->json(['success' => 'Successfully Added on your Cart']);
        } else {
            $data = array();
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = $request->qty;
            $data['price'] = $product->selling_price;
            $data['weight'] = 1;
            $data['options']['slug'] = $product->slug;
            $data['options']['code'] = $product->product_code;
            $data['options']['image'] = $product->featured_image;
            $data['options']['color'] = $request->p_color;
            $data['options']['size'] = $request->p_size;
            $data['options']['capacity'] = $request->p_capacity;
            Cart::add($data);
            return response()->json(['success' => 'Successfully added on your Cart']);
        }
    }

    /**
     * Add to cart single product page.
     *
     * @param  //Request  $request
     * @return //Response
     */
    public function Cart(Request $request ,$id)
    {
        $product = Product::where('id', $id)->first();
        if ($product->discount_price) {
            $data = array();
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = $request->qty;
            $data['price'] = $product->discount_price;
            $data['weight'] = 1;
            $data['options']['slug'] = $product->slug;
            $data['options']['code'] = $product->product_code;
            $data['options']['image'] = $product->featured_image;
            $data['options']['color'] = $request->color;
            $data['options']['size'] = $request->size;
            Cart::add($data);
            $notification = array(
                'messege' => 'Successfully added on your Cart',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        } else {
            $data = array();
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = $request->qty;
            $data['price'] = $product->selling_price;
            $data['weight'] = 1;
            $data['options']['slug'] = $product->slug;
            $data['options']['code'] = $product->product_code;
            $data['options']['image'] = $product->featured_image;
            $data['options']['color'] = $request->color;
            $data['options']['size'] = $request->size;
            Cart::add($data);
            $notification['messege'] = 'Successfully added on your Cart';
            $notification['alert-type'] = 'success';

            return back()->with($notification);
        }
    }

    /**
     * Remove cart from single product page.
     *
     * @param  //id
     * @return //Response
     */

    public function Delete($id)
    {
        Cart::remove($id);
        $notification['messege'] = 'Successfully deleted your Cart';
        $notification['alert-type'] = 'success';

        return back()->with($notification);
    }

    /**
     * Remove  all cart from cart page.
     *
     * @param  //id
     * @return //Response
     */

    public function AllDelete()
    {
        Cart::destroy();
        $notification['messege'] = 'Successfully clear cart page';
        $notification['alert-type'] = 'success';

        return back()->with($notification);
    }

    public function Update(Request $request, $id)
    {
        $product_id = $id;
        $qty = $request->qty;
        Cart::update($product_id, $qty);

        $notification['messege'] = 'Successfully updated your Cart';
        $notification['alert-type'] = 'success';
        return back()->with($notification);
    }

    /**
     * Remove cart from Top Bar Cart Option.
     *
     * @param  //id
     * @return //Response
     */

    public function CartRemove($id)
    {
        Cart::remove($id);
        return response()->json(['success' => 'Successfully removed your Cart product']);
    }

}
