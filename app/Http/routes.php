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

use \App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;


Route::group(['middlewareGroups'=>['web' , 'auth']] , function(){

    Route::get('/', function () {
        return view('welcome');
    })->name('home');


    Route::post('/signup' , [
        'uses'=>'UserController@postSignUp',
        'as'=>'signup'
    ]);

    Route::post('/signin' , [
        'uses'=>'UserController@postSignIn',
        'as'=>'signin'
    ]);

    Route::get('/logout' , [
        'uses' => 'UserController@getLogout',
        'as' => 'logout'
    ]);

    Route::get('/account' , [
        'uses' => 'UserController@getAccount',
        'as' => 'account'
    ]);

    Route::get('/userimage/{filename}' , [
        'uses' => 'UserController@getUserImage',
        'as' => 'account.image'
    ]);

    Route::post('/updateaccount' , [
        'uses' => 'UserController@postSaveAccount',
        'as' => 'account.save'
    ]);

    Route::get('/dashboard' , [
            'uses' => 'PostController@dashboard',
            'as' => 'dashboard',
            'middleware' => 'auth'
    ]);

    Route::post('/createpost' , [
       'uses' => 'PostController@postCreatePost',
       'as' => 'post.create'
    ]);

    Route::get('/delete/{post_id}' , [
        'uses' => 'PostController@getPostDelete',
        'as' => 'post.delete',
        'auth' => 'middleware'
    ]);

    Route::Post('/edit' , [
        'uses' => 'PostController@postEditPost',
        'as' => 'edit',
        'middleware' => 'auth'
    ]);

    Route::post('/like' , [
        'uses' => 'PostController@postLikePost',
        'as' => 'like'
    ]);
});
