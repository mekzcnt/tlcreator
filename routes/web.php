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

Route::get('/', 'HomeController@index');

Route::get('/about', function () {
     return view('pages.about');
});

Route::get('/contact', function () {
     return view('pages.contact');
});

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::post('auth/register', 'Auth\RegisterController@postRegister');

Route::get('/feed', 'FeedController@index');

Route::get('/timeline', function(){ return redirect('/');});
Route::get('/timeline/{id}', ['as'=>'feed.timeline', 'uses'=>'UserPostsController@post']);
Route::get('/timeline/{id}/embed', 'UserPostsController@embed');
Route::get('/category/{id}','CategoryController@show');
Route::get('/{username}', 'UserController@getProfile');

Route::get('comment/like/{id}', ['as' => 'comment.like', 'uses' => 'LikeController@likeComment']);
Route::get('post/like/{id}', ['as' => 'post.like', 'uses' => 'LikeController@likePost']);

Route::group(['middleware'=>'admin'], function() {

    Route::get('/admin/dashboard', function(){
      return view('admin.index');
    });

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

Route::group(['middleware'=>'auth', 'name'=>''], function(){
    Route::post('/comment/reply', 'CommentRepliesController@createReply');

    Route::resource('/timeline/posts', 'UserPostsController',['names'=>[
        'create'=>'auth.timeline.create',
        'store'=>'auth.timeline.store',
        'edit'=>'auth.timeline.edit'
    ]]);

    Route::post('/timeline/posts/{postId}/create/add', 'UserPostsController@addEvent')->name('addEvent');
    Route::post('/timeline/posts/{postId}/create/update/{id}', 'UserPostsController@updateEvent');
    Route::delete('/timeline/posts/{postId}/create/delete/{id}', 'UserPostsController@deleteEvent');
    Route::delete('/timeline/posts/{postId}/create/deleteAll', 'UserPostsController@deleteAllEvent');

    // Route::get('/profile', 'UserController@getProfile');
    Route::get('/profile/edit', 'UserController@getUpdateProfile');
    Route::patch('/profile/edit', 'UserController@UpdateProfile');

    // Route::resource('/profile/edit/', 'UserController',['names'=>[
    //     'updateProfile'=>'auth.profile.edit'
    // ]]);


});
