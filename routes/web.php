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

Route::get('/timeline/{id}', ['as'=>'feed.timeline', 'uses'=>'AdminPostsController@post']);

Route::group(['middleware'=>'admin', ], function() {

    Route::get('/admin', function(){ return view('admin.index');});

    Route::resource('admin/users', 'AdminUsersController',['names'=>[
        'index'=>'admin.users.index',
        'create'=>'admin.users.create',
        'store'=>'admin.users.store',
        'edit'=>'admin.users.edit'
    ]]);

    Route::resource('admin/posts', 'AdminPostsController',['names'=>[
        'index'=>'admin.posts.index',
        'create'=>'admin.posts.create',
        'store'=>'admin.posts.store',
        'edit'=>'admin.posts.edit'
    ]]);

    Route::resource('admin/categories', 'AdminCategoriesController',['names'=>[
        'index'=>'admin.categories.index',
        'create'=>'admin.categories.create',
        'store'=>'admin.categories.store',
        'edit'=>'admin.categories.edit'
    ]]);

    Route::resource('admin/media', 'AdminMediasController',['names'=>[
        'index'=>'admin.media.index',
        'create'=>'admin.media.create',
        'store'=>'admin.media.store',
        'edit'=>'admin.media.edit'
    ]]);


    Route::resource('admin/comments', 'PostCommentsController',['names'=>[
        'index'=>'admin.comments.index',
        'create'=>'admin.comments.create',
        'store'=>'admin.comments.store',
        'edit'=>'admin.comments.edit',
        'show'=>'admin.comments.show'
    ]]);

    Route::resource('admin/comment/replies', 'CommentRepliesController',['names'=>[
        'index'=>'admin.replies.index',
        'create'=>'admin.replies.create',
        'store'=>'admin.replies.store',
        'edit'=>'admin.replies.edit',
        'show'=>'admin.replies.show'
    ]]);

});

Route::group(['middleware'=>'auth'], function(){
    Route::post('comment/reply', 'CommentRepliesController@createReply');

    Route::get('/profile', 'UserController@getProfile');
    Route::get('/profile/edit', 'UserController@getUpdateProfile');
    Route::patch('/profile/edit', 'UserController@updateProfile');
});
