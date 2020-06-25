<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * View wishlist via route.
     *
     * @param  //Request  $request
     * @return //Response
     */

    public function Show()
    {
        $user_id = Auth::id();
        $wishlist = Wishlist::where('user_id', $user_id)->paginate(5);
        return view('customer-dashboard/wishlist', compact('wishlist'));
    }

    /**
     * Delete existing wishlist via route.
     *
     * @param  //Request  $request
     * @return //Response
     */
    public function Delete($id, $ran)
    {
        $user_id = Auth::id();
        $check = Wishlist::where('user_id', $user_id)->where('product_id', $id)->first();

        if (Auth::check()) {
            if ($check) {
                $check->forceDelete();
                $notification = array(
                    'messege' => 'Wishlist successfully removed',
                    'alert-type' => 'success'
                );
                return back()->with($notification);
            }
        }
    }
}
