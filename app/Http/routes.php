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


Route::auth();
Route::get('/feed', 'HomeController@index');

Route::get('/post/{id}', ['as'=>'home.post', 'uses'=>'AdminPostsController@post']);



Route::group(['middleware'=>'admin'], function(){

    Route::get('/admin', function(){

        return view('admin.index');


    });


    Route::resource('admin/users', 'AdminUsersController');

    Route::resource('admin/posts', 'AdminPostsController');

    Route::resource('admin/categories', 'AdminCategoriesController');

    Route::resource('admin/media', 'AdminMediasController');


    Route::resource('admin/comments', 'PostCommentsController');

    Route::resource('admin/comment/replies', 'CommentRepliesController');

});

Route::resource('admin/users', 'AdminUsersController');
