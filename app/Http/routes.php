<?php


use App\Post;
use App\User;

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

Route::get('/about', function () {
     return view('pages.about');
});
//
Route::get('/login', function () {
     return view('pages.login');
});

// Route:get('/post/{id}', 'PostsController@index');

Route::get('/post/{id}', 'PostsController@show_post');

Route::auth();
Route::get('/feed', 'HomeController@index');

Route::resource('admin/users', 'AdminUserController');
