<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
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
     * Show the application reviews.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $review = Review::paginate(10);
        return view('admin.pages.review.review', compact('review'));
    }

    /**
     * Delete existing review.
     *
     * @param  //id
     * @return //view
     */

    public function delete($id)
    {
        $review = Review::find($id);
        $review->forceDelete();
        $notification = array(
            'messege' => 'Review successfully deleted',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
