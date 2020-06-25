<?php

namespace App\Http\Controllers\Admin\Newsletter;

use App\Http\Controllers\Controller;
use App\Models\Admin\Newsletter;
use Illuminate\Http\Request;

class NewslettersController extends Controller
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
     * Show the application newsletters.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $newsletters = Newsletter::paginate(10);
        return view('admin.pages.tools.newsletters.newsletters', compact('newsletters'));
    }

    /**
     * Delete existing newsletter email.
     *
     * @param  //id
     * @return //view
     */
    public function delete($id)
    {
        $coupon = Newsletter::find($id);
        $coupon->forceDelete();
        $notification=array(
            'messege'=>'Newsletter Email successfully deleted',
            'alert-type'=>'error'
        );
        return redirect()->back()->with($notification);
    }
}
