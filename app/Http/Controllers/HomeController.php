<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Defines\Define;
use Auth;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // return redirect()->route('admin.index');
        if (Auth::user()->role_id == Define::ADMIN) {
            return redirect()->route('admin.index');
        }

        return redirect()->route('login');
    }

    // public function admin()
    // {
    //     $this->middleware('auth');
    //     if (Auth::user()->role_id == Define::ADMIN) {
    //         return redirect()->route('admin.index');
    //     }

    //     return redirect()->route('login');
    // }
}
