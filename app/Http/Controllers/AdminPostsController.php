<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostsCreateRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // $posts = Post::orderBy('id', 'desc')->paginate(10);
      $posts = Post::all();
      return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories = Category::pluck('name','id')->all();
      return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        $input = $request->all();

        $user = Auth::user();

        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();

            $file->move('uploads', $name);
            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }

        // $tl = $request->timeline;
        // $tl = preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $tl);
        // $input['timeline'] = json_encode($tl, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $input['timeline'] = $request->timeline;

        $user->posts()->create($input);

        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::pluck('name','id')->all();
        return view('admin.posts.edit', compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        if($file = $request->file('photo_id')){
              $name = time() . $file->getClientOriginalName();

              $file->move('uploads', $name);
              $photo = Photo::create(['file'=>$name]);

              $input['photo_id'] = $photo->id;
        }

        //Updata data which you edit them in forms
        Auth::user()->posts()->whereId($id)->first()->update($input);

        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Check if the post has a photo:
        if(isset($post->photo->file)) {
          unlink(public_path() . $post->photo->file);
        }

        //Delete a photo when delete a post
        $posts = DB::select('SELECT * FROM posts WHERE user_id = ?', [$id]);
        foreach ($posts as $post) {
          if ($post->photo_id) {
            $photo = Photo::findOrFail($post->photo_id);
            unlink(public_path() . $photo->file);
            $photo->delete();
          }
        }

        $post->delete();

        return redirect('/admin/posts');
    }




}
