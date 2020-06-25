<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LoginDisable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->status == 0 ) {
            Auth::logout();

            $notification = array(
                'messege' => 'Your account has been disable',
                'alert-type' => 'error'
            );
            return redirect()->route('admin.login')->with($notification);
        }
        return $next($request);
    }
}
