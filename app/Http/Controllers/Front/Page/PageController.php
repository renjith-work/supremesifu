<?php

namespace App\Http\Controllers\Front\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
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
