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
}
