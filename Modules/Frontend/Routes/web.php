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

// Route::prefix('frontend')->group(function() {
    // Route::get('/', 'FrontendController@index');
// });

Route::get('/', 'HomeController@index')->name('home');
Route::get('menu', 'HomeController@menu')->name('menu');
Route::get('highlight', 'HomeController@highlight')->name('highlight');
Route::get('explore', 'HomeController@explore')->name('explore');
Route::get('populer', 'HomeController@trending')->name('trending');
Route::get('vc/{slug}', 'SlugController@category')->name('category');
Route::get('v/{slug}', 'SlugController@detail')->name('details');
Route::get('preview/{id}', 'SlugController@getPostsPreview')->name('preview');
Route::get('tag/{slug}', 'SlugController@tag')->name('tag');
Route::get('user/{name}','SlugController@user')->name('user');
Route::get('/page/{slug}', 'SlugController@page')->name('page');
Route::get('/search', 'HomeController@search')->name('search');

Route::post('/search', 'HomeController@search')->name('searchpost');

Route::get('/sitemap.xml','XmlController@XML');
Route::get('/sitemap_home.xml','XmlController@XML_home');
Route::get('/sitemap_post.xml','XmlController@XML_post');
Route::get('/sitemap_postnews.xml','XmlController@XML_postnews');
Route::get('/sitemap_category.xml','XmlController@XML_category');
Route::get('/sitemap_tag.xml','XmlController@XML_tag');
Route::get('/sitemap_page.xml','XmlController@XML_page');

Route::get('/feed','XmlController@XML_rss');