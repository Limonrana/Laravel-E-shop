<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
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

    public function index()
    {
        return view('admin.auth.passwords.change-password');
    }

    public function Update( Request $request)
    {
        $password = Auth::user()->password;
        $oldpass  = $request->oldpass;
        $newpass = $request->password;
        $c_pass = $request->password_confirmation;

        if (Hash::check($oldpass, $password)) {
            if ($newpass == $c_pass) {
                $user = Admin::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Auth::logout();
                $notification=array(
                    'messege'=>'Password Changed Successfully ! Now Login with Your New Password',
                    'alert-type'=>'success'
                );
                return redirect()->route('admin.login.form')->with($notification);
            }
            else{
                $notification=array(
                    'messege'=>'New password and Confirm Password not matched!',
                    'alert-type'=>'error'
                );
                return Redirect()->back()->with($notification);
            }
        }
        else{
            $notification=array(
                'messege'=>'Old Password not matched!',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
}
