<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Nexmo\Response;

class WishlistController extends Controller
{
    /**
     * Store a new wishlist vai ajax.
     * &&
     * Delete existing wishlist via ajax.
     *
     * @param  //Request  $request
     * @return //Response
     */
    public function Store($id)
    {
        $user_id = Auth::id();
        $check = Wishlist::where('user_id', $user_id)->where('product_id', $id)->first();

        if (Auth::check()){
            if ($check) {
                $check->forceDelete();
                return \Response::json(['success' => 'Product Deleted successfully from wishlist']);
            }
            else {
                $wishlist = new Wishlist();
                $wishlist->user_id      = $user_id;
                $wishlist->product_id   = $id;
                $wishlist->save();
                return \Response::json(['success' => 'Product added in successfully your wishlist']);
            }
        }
        else {
            return \Response::json(['warning' => 'You must need login for adding wishlist.']);
        }
    }
}
