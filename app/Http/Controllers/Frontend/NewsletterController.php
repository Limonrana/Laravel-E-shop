<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Store a new newsletter email.
     *
     * @param  //Request  $request
     * @return //Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|unique:newsletters|max:55',
        ]);

        $newsletter = new Newsletter();
        $newsletter->email = $request->email;
        $newsletter->save();
        $notification=array(
            'messege'=>'Thanks for subscribing here',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
}
