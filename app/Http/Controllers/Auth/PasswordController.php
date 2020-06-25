<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function index()
    {
        return view('auth.passwords.change-password');
    }

    public function Update( Request $request)
    {
        $password = Auth::user()->password;
        $oldpass  = $request->oldpass;

        if (Hash::check($oldpass, $password)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login');
        }
    }
}
