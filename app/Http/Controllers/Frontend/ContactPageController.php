<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactPageController extends Controller
{
    /**
     * Show the application contact page.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.contact');
    }

    /**
     * Send a new email from contact page.
     *
     * @param  //Request  $request //Mail
     * @return //Response
     */

    public function mail( Request $request)
    {
        $validatedData = $request->validate([
            'contact_name' => 'required',
            'contact_email' => 'required|email',
            'contact_phone' => 'required',
            'contact_message' => 'required',
        ]);

        $data = $request;
        //Mail Send
        Mail::to("limonrana515@gmail.com")->send(new ContactMail($data));

        $notification=array(
            'messege'=>'Contact email send successfully done',
            'alert-type'=>'success'
        );
        return back()->with($notification);

    }
}
