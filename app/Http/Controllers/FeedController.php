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
        $categories = Category::orderBy('id', 'desc')->get();
        $lastestPosts = Post::take(4)->orderBy('id', 'desc')->get();
        $recommend_1 = Post::where('id','=',115)->first();
        $recommend_2 = Post::where('id','=',51)->first();
        $recommend_3 = Post::where('id','=',22)->first();
        $recommend_4 = Post::where('id','=',11)->first();
        return view('auth.feed',
          compact('categories', 'lastestPosts', 'recommend_1', 'recommend_2', 'recommend_3', 'recommend_4'));
    }
}
