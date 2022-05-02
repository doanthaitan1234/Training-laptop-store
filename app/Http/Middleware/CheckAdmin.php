<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Defines\Define;
use Auth;

class CheckAdmin
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
            if (Auth::user()->role_id == Define::ADMIN) {
                if (Auth::user()->status == Define::ACTIVE) {
                    return $next($request);
                }
                else {
                    $message = 'Your account is not actived!';
                    return view('auth.login', compact('message'));
                }
            } else {
                return view('404');
            }
            
        } else {
            $message = 'Login fail!';

             return view('auth.login', compact('message'));
        }
    }
}
