<?php

namespace App\Http\Controllers;
use Mail;
use App\Mail\NewUserWelcome;
use Illuminate\Http\Request;
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
        // $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('front.demo.home');
    }

    public function test()
    {
        return view('front.demo.test');
    }
        
    public function mail()
    {
        Mail::to(Auth::user()->email)->send(new NewUserWelcome());
        return redirect()->back();
    }
}
