<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::where('featured', 1)->orderBy('id', 'desc')->take(3)->get();
        return view('front.pages.home')->with('posts', $posts);
    }

    public function suspended(){
        return view('front.auth.suspended');
    }

    public function contact()
    {
        return view('front.support.contact');
    }

    public function about()
    {
        return view('front.pages.about');
    }
    
    public function deliveryReturns(){
        return view('front.pages.deliveryReturns');
    }

    public function howitworks(){
        return view('front.pages.howitworks');
    }

    public function ourHistory(){
        return view('front.pages.ourHistory');
    }

    public function termsConditions(){
        // return view('front.pages.termsConditions');
        return view('front.terms');
    }

    public function perfectFit(){
        return view('front.pages.perfectFit');
    }

    public function privacy(){
        return view('front.pages.privacyPolicy');
    }

    public function faq(){
        return view('front.pages.faq');
    }
}
