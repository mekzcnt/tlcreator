<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Post;
use App\Category;
use App\Like;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $recommend_1 = Post::where('id','=',7)->first();
        $recommend_2 = Post::where('id','=',20)->first();
        $recommend_3 = Post::where('id','=',23)->first();
        $recommend_4 = Post::where('id','=',24)->first();
        // $mostliked = Like::where('likeable_type','=','App\Post')->distinct('likeable_id')->count();
        //dd($mostliked);
        // $duplicates = DB::table('likeables')
        //     ->select('likeable_id')
        //     ->where('likeable_type', 'App\Post')
        //     ->groupBy('likeable_id')
        //     ->havingRaw('COUNT(*) > 1')
        //     ->get();
            //dd($duplicates);
        return view('auth.feed',
          compact('duplicates', 'categories', 'lastestPosts', 'recommend_1', 'recommend_2', 'recommend_3', 'recommend_4'));
    }
}
