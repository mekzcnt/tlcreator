<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/', function () {
    return view('pages.welcome');
});

Route::get('/about', function () {
     return view('pages.about');
});

Route::get('/contact', function () {
     return view('pages.contact');
});

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/feed', 'HomeController@index');

Route::group(['middleware'=>'admin'], function() {

    Route::get('/admin', function(){
      return view('admin.index');
    });

    Route::resource('admin/users', 'AdminUsersController');
    Route::resource('admin/posts', 'AdminPostsController');
    Route::resource('admin/categories', 'AdminCategoriesController');
    Route::resource('admin/media', 'AdminMediasController');

    Route::resource('admin/comments', 'PostCommentsController');
    Route::resource('admin/comments/replies', 'CommentRepliesController');

});
