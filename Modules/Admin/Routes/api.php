<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/admin', function (Request $request) {
//     return $request->user();
// });

Route::get('post/category/all', [
  'uses' => 'Api\ApiController@all',
  'as'   => 'api-post-all'
])->middleware('cors');

Route::get('post/category/{slug}', [
  'uses' => 'Api\ApiController@category',
  'as'   => 'api-post-category'
])->middleware('cors');

Route::get('post/detail/{id}', [
  'uses' => 'Api\ApiController@detail',
  'as'   => 'api-post-detail'
])->middleware('cors');

Route::get('post/detail/related/{id}', [
  'uses' => 'Api\ApiController@related',
  'as'   => 'api-post-related'
])->middleware('cors');

Route::get('post/highlight', [
  'uses' => 'Api\ApiController@highlight',
  'as'   => 'api-post-highlight'
])->middleware('cors');

Route::get('post/trending', [
  'uses' => 'Api\ApiController@trending',
  'as'   => 'api-post-trending'
])->middleware('cors');

Route::get('/search', [
  'uses' => 'Api\ApiController@search',
  'as'   => 'api-search'
])->middleware('cors');

Route::get('apps/version', [
  'uses' => 'Api\ApiController@version',
  'as'   => 'api-version'
])->middleware('cors');

Route::get('banner', [
  'uses' => 'Api\ApiController@banner',
  'as'   => 'api-banner'
])->middleware('cors');

Route::get('page/{slug}', [
  'uses' => 'Api\ApiController@page',
  'as'   => 'api-page'
])->middleware('cors');