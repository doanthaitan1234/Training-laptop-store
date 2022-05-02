<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Defines\Define;
use Illuminate\Support\Facades\Session;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()) {
            if (Auth::user()->role_id == Define::USER) {
                if (Auth::user()->status == Define::ACTIVE) {
                    return $next($request);
                }
                else {
                    Session::flash('message', __('Your account is not actived!'));
                    return response()->view('auth.login');
                }
            } else {
                return response()->view('404');
            }
            
        } else {
            Session::flash('message', __('Login fail!'));
            return response()->view('auth.login');
        }
    }
}
