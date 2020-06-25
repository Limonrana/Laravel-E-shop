<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view('customer-dashboard.dashboard');
    }

    /**
     * Show the application account.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */
    public function account()
    {
        $profile = User::where('id', Auth::id())->first();
        return view('customer-dashboard.my-account', compact('profile'));
    }

    /**
     * Show the application billing address.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */
    public function billing()
    {
        return view('customer-dashboard.billing');
    }

    /**
     * Show the application new order.
     *
     * @return //\Illuminate\Contracts\Support\Renderable
     */

    public function show()
    {
        $profile = User::where('id', Auth::id())->first();
        return view('customer-dashboard.my-account', compact('profile'));
    }

    /**
     * update existing customer.
     *
     * @param  //id, //Request  $request
     * @return //Response
     */

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name'          => 'required|max:85',
            'email'         => 'required|max:55',
        ]);

        $customer               = User::find($id);
        $customer->name         = $request->name;
        $customer->email        = $request->email;
        $customer->phone        = $request->phone;
        $customer->address_1    = $request->address_1;
        $customer->address_2    = $request->address_2;
        $customer->city         = $request->city;
        $customer->state        = $request->state;
        $customer->zip          = $request->zip;
        $customer->country      = $request->country;

        $customer->save();
        $notification = array(
            'messege' => 'Profile successfully updated',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
