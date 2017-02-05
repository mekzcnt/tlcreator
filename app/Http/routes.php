<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('pages.welcome');
});

// Route::get('/about', function () {
//     return view('pages.about');
// });
//

// Route:get('/post/{id}', 'PostsController@index');

Route::get('/contact', 'PostController@contact');
Route::get('/post/{id}', 'PostsController@show_post');


// Route::get('/login', function () {
//     return view('pages.login');
// });

Route::auth();
Route::get('/feed', 'HomeController@index');

Route::get('/create', function(){
  $user = User:findOrFail(1);
  $user->posts()->save(new Post([
    'title'=>'My first post',
    'body'=>'I love Laravel, with Jenpasit Puprasert'
  ]));
});

Route::get('/read', function(){
  $user = User:findOrFail(1);
  dd($user->posts);
});
