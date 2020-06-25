<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
use App\Models\Admin\OrderDetail;
use App\Models\Frontend\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{
    /**
     * Show the application product.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */

    /**
     * Store a new product review.
     *
     * @param  //Request  $request
     * @return //Response
     */
    public function store(Request $request, $id, $ord_id)
    {
        $user_id = Auth::user()->id;
        $validatedData = $request->validate([
            'ratings' => 'required',
            'value' => 'required',
            'price' => 'required',
            'review' => 'required|max:450',
        ]);

        $review = new Review();
        $review->user_id    = $user_id;
        $review->product_id = $id;
        $review->ratings    = $request->ratings;
        $review->value      = $request->value;
        $review->price      = $request->price;
        $review->review     = $request->review;
        $review->save();

        if ($review->id) {
            $order_details = OrderDetail::where('product_id', $id)->where('user_id', $user_id)->where('order_id', $ord_id)->first();
            $order_details->review = 1;
            $order_details->save();
        }
        else {
            $notification = array(
                'messege' => 'Opps! not done yet, Please try again!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
        $notification = array(
            'messege' => 'Review successfully added',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
