<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index()
  {
      $posts = Post::all();
      return view('auth.profile.index', compact('posts'));
  }
  public function getProfile()
  {
      $viewData = [
          'currentUser' => auth()->user()
      ];

      return view('auth.profile.index', $viewData);
  }

  public function getUpdateProfile()
  {
      $viewData = [
          'currentUser' => auth()->user()
      ];

      return view('auth.profile.edit', $viewData);
  }

  public function UpdateProfile(Request $request)
  {
      $this->validate($request, [
          'name' => 'required|alpha',
          'email' => 'required|email',
          'username' => 'required|max:255',
      ]);

      $user = auth()->user();
      // $user->fill($request->all());
      $user->name = $request->name;
      $user->email = $request->email;
      $user->username = $request->username;
      // $user->sex = $request->sex;

//        don't have photo_id yet.

      $user->save();

      return redirect('/profile');
  }
}
