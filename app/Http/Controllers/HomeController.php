<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Post;
use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::take(4)->orderBy('id', 'desc')->get();
        $categories = Category::get();

        return view('web.feed', compact('categories','posts'));
    }
}
