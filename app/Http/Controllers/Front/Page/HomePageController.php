<?php

namespace App\Http\Controllers\Front\Page;

use App\Models\Post\Post;
use App\Models\Product\ProductDesign;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function index()
    {
        $posts = Post::where('featured', 1)->orderBy('id', 'desc')->take(3)->get();
        // $products = ProductDesign::where('user_id', 1)->orderBy('id', 'desc')->get();
        $products = ProductDesign::orderBy('id', 'desc')->get();
        return view('front.pages.home')->with('posts', $posts)->with('products', $products);
    }
}
