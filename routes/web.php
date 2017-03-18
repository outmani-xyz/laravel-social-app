<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */
Route::group(['middleware' => 'web'], function() {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
    Route::get('/logout', ['uses' => 'UserController@getLogout', 'as' => 'user.logout']);
    Route::post('/signup', ['uses' => 'UserController@postSignup', 'as' => 'user.signup']);
    Route::post('/signin', ['uses' => 'UserController@postSignin', 'as' => 'user.signin']);
    Route::get('/account',['uses'=>'UserController@getAccount','as'=>'user.account']);
    Route::post('/account/update',['uses'=>'UserController@postAccount','as'=>'user.account.save']);
    Route::get('/dashboard', ['uses' => 'PostController@getDashboard', 'as' => 'user.dashboard']);
    Route::post('/post/create',['uses'=>'PostController@postCreatePost','as'=>'post.create']);
    Route::post('/post/edit',['uses'=>'PostController@postEditPost','as'=>'post.edite']);
    Route::get('/post/delete/{post_id}',['uses'=>'PostController@getDeletePost','as'=>'post.delete']);
    Route::get('/user/image/{file}',['uses'=>'UserController@getImage','as'=>'user.image']);
    Route::post('/like',['uses'=>'PostController@postLike','as'=>'post.like']);
});
