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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::group(['namespace' => 'Auth'], function () {
//   //admin login route
//   Route::get( '/admin/me/login', [
//     'uses' => 'AuthController@goToAdminLoginPage',
//     'as'   => 'admin.login'
//   ]);
//   Route::post( '/admin/me/login' , [
//     'uses' => 'AuthController@postAdminLogin',
//     'as'   => 'admin.post_login'
//   ]);
//   //admin logout route
//   Route::post( '/admin/me/logout', [
//     'uses' => 'AuthController@logoutFromLogin',
//     'as'   => 'admin.logout'
//   ]);
// });

// Route::group(['prefix' => 'admin'], function () {
//   //cache clear route 
//   Route::get('/clear-cache', [
//     'uses' => 'Admin\Dashboard\HomeController@clearCache',
//     'as'   => 'admin.clearCache'
//   ]);

//   Route::get('home', [
//     'uses' => 'Admin\Dashboard\HomeController@index',
//     'as'   => 'admin.home'
//   ])->middleware('admin', 'sufficientPermission');

//   Route::get('category', [
//     'uses' => 'Admin\Post\PostController@category',
//     'as'   => 'admin.category'
//   ])->middleware('admin', 'sufficientPermission');

//   Route::get('user/list', [
//     'uses' => 'Admin\User\UserController@index',
//     'as'   => 'admin.user_list'
//   ])->middleware('admin', 'sufficientPermission');

//   Route::get('user/create', [
//     'uses' => 'Admin\User\UserController@create',
//     'as'   => 'admin.user_create'
//   ])->middleware('admin', 'sufficientPermission');

//   Route::get('user/update/{slug}', [
//     'uses' => 'Admin\User\UserController@update',
//     'as'   => 'admin.user_update'
//   ])->middleware('admin', 'sufficientPermission');

//   Route::get('post/list', [
//     'uses' => 'Admin\Post\PostController@index',
//     'as'   => 'admin.post_list'
//   ])->middleware('admin', 'sufficientPermission');

//   Route::get('post/create', [
//     'uses' => 'Admin\Post\PostController@create',
//     'as'   => 'admin.post_create'
//   ])->middleware('admin', 'sufficientPermission');

//   Route::get('post/category', [
//     'uses' => 'Admin\Post\PostController@category',
//     'as'   => 'admin.post_category'
//   ])->middleware('admin', 'sufficientPermission');

//   Route::get('post/tag', [
//     'uses' => 'Admin\Post\PostController@tag',
//     'as'   => 'admin.post_tag'
//   ])->middleware('admin', 'sufficientPermission');

// });

// Route::group(['prefix' => 'admin'], function () {
//   Route::post('user/create', [
//     'uses' => 'Admin\User\UserController@saveUser',
//     'as'   => 'admin.save_user_create'
//   ]);
//   Route::post('user/update/{slug}', [
//     'uses' => 'Admin\User\UserController@saveUser',
//     'as'   => 'admin.update_user'
//   ]);
// });

// Route::get('/', [
//     'uses' => 'Frontend\Home\HomeController@index',
//     'as'   => 'frontend.home'
//   ]);
