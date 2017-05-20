<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Post;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

  public function getProfile($username)
  {
      $currentUser = User::where('username', $username)->firstOrFail();
      // $posts = User::where('username', $username)->firstOrFail()->posts;
      // $user = auth()->user();
      $posts = Post::where("user_id", "=", $currentUser->id)->orderBy('id', 'desc')->paginate(12);

      return view('auth.profile.index', compact('posts','currentUser'));
  }

  public function getUpdateProfile()
  {
      $currentUser = auth()->user();

      return view('auth.profile.edit', compact('currentUser'));
  }

  public function UpdateProfile(Request $request)
  {
      $user = auth()->user();

      $this->validate($request, [
          'name' => 'required|max:255',
          'email' => 'required|email',
          'username' => 'required|max:255',
      ]);

      $user->name = $request->name;
      $user->email = $request->email;
      $user->username = $request->username;

      if($file = $request->file('photo_id')) {
        $name = time() . $file->getClientOriginalName();
        $file->move('uploads', $name);
        $photo = Photo::create(['file'=>$name]);
        $user->photo_id = $photo->id;
      }

      $user->save();

      return redirect('/profile/edit');
  }
}
