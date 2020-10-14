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

// Route::prefix('admin')->group(function() {
//     Route::get('/', 'AdminController@index');
// });

Route::get('/bakpau982', [
    'uses' => 'Dashboard\DashboardController@bakpau',
    'as'   => 'admin.bakpau'
  ]);

Route::group(['namespace' => 'Auth'], function () {
  //admin login route
  Route::get( '/bakpau982/me/login', [
    'uses' => 'AuthController@goToAdminLoginPage',
    'as'   => 'admin.login'
  ]);
  Route::post( '/bakpau982/me/login' , [
    'uses' => 'AuthController@postAdminLogin',
    'as'   => 'admin.post_login'
  ]);  
  //admin logout route
  Route::post( '/bakpau982/me/logout', [
    'uses' => 'AuthController@logoutFromLogin',
    'as'   => 'admin.logout'
  ]);
});

Route::group(['prefix' => 'bakpau982'], function () {
  //cache clear route 
  Route::get('/clear-cache', [
    'uses' => 'Dashboard\DashboardController@clearCache',
    'as'   => 'admin.clearCache'
  ]);

  Route::get('home', [
    'uses' => 'Dashboard\DashboardController@index',
    'as'   => 'admin.home'
  ])->middleware('admin', 'sufficientPermission');

  Route::get('category', [
    'uses' => 'Post\PostController@category',
    'as'   => 'admin.category'
  ])->middleware('admin', 'sufficientPermission');

  Route::get('user/list', [
    'uses' => 'User\UserController@index',
    'as'   => 'admin.user_list'
  ])->middleware('admin', 'sufficientPermission');

  Route::get('user/create', [
    'uses' => 'User\UserController@create',
    'as'   => 'admin.user_create'
  ])->middleware('admin', 'sufficientPermission');

  Route::get('user/update/{slug}', [
    'uses' => 'User\UserController@update',
    'as'   => 'admin.user_update'
  ])->middleware('admin', 'sufficientPermission');

  Route::get('post/list', [
    'uses' => 'Post\PostController@index',
    'as'   => 'admin.post_list'
  ])->middleware('admin', 'sufficientPermission');

  Route::get('post/create', [
    'uses' => 'Post\PostController@create',
    'as'   => 'admin.post_create'
  ])->middleware('admin', 'sufficientPermission');

  Route::get('post/update/{slug}', [
    'uses' => 'Post\PostController@update',
    'as'   => 'admin.post_update'
  ])->middleware('admin', 'sufficientPermission');

  Route::get('post/category', [
    'uses' => 'Post\PostController@category',
    'as'   => 'admin.post_category'
  ])->middleware('admin', 'sufficientPermission');

  Route::get('post/category/{id}', [
    'uses' => 'Post\PostController@categoryUpdate',
    'as'   => 'admin.post_category_update'
  ])->middleware('admin', 'sufficientPermission');

  Route::get('post/tag', [
    'uses' => 'Post\PostController@tag',
    'as'   => 'admin.post_tag'
  ])->middleware('admin', 'sufficientPermission');

  Route::get('post/tag/{id}', [
    'uses' => 'Post\PostController@tagUpdate',
    'as'   => 'admin.post_tag_update'
  ])->middleware('admin', 'sufficientPermission');

  Route::get('listing/list', [
    'uses' => 'Listing\ListingController@index',
    'as'   => 'admin.listing_list'
  ])->middleware('admin', 'sufficientPermission');

  Route::get('listing/area', [
    'uses' => 'Listing\ListingController@area',
    'as'   => 'admin.listing_area'
  ])->middleware('admin', 'sufficientPermission');

  Route::get('listing/cat', [
    'uses' => 'Listing\ListingController@category',
    'as'   => 'admin.listing_category'
  ])->middleware('admin', 'sufficientPermission');

  Route::get('listing/tag', [
    'uses' => 'Listing\ListingController@tag',
    'as'   => 'admin.listing_tag'
  ])->middleware('admin', 'sufficientPermission');

  Route::get('banner', [
    'uses' => 'Banner\BannerController@index',
    'as'   => 'admin.banner_list'
  ])->middleware('admin', 'sufficientPermission');

  Route::get('banner/{id}', [
    'uses' => 'Banner\BannerController@bannerUpdate',
    'as'   => 'admin.banner_update'
  ])->middleware('admin', 'sufficientPermission');

  Route::get('page', [
    'uses' => 'Page\PageController@index',
    'as'   => 'admin.page_list'
  ])->middleware('admin', 'sufficientPermission');

  Route::get('page/{id}', [
    'uses' => 'Page\PageController@pageUpdate',
    'as'   => 'admin.page_update'
  ])->middleware('admin', 'sufficientPermission');

  Route::get('setting/param', [
    'uses' => 'Setting\SettingController@param',
    'as'   => 'admin.param_list'
  ])->middleware('admin', 'sufficientPermission');

  // gallery

  Route::get('post/gallery', [
    'uses' => 'Gallery\GalleryController@index',
    'as'   => 'admin.post_gallery'
  ])->middleware('admin', 'sufficientPermission');

  Route::get('post/gallery/{id}', [
    'uses' => 'Gallery\GalleryController@galleryUpdate',
    'as'   => 'admin.gallery_update'
  ])->middleware('admin', 'sufficientPermission');

  Route::get('post/gallery/{id}/media/', [
    'uses' => 'Gallery\GalleryController@galleryMedia',
    'as'   => 'admin.gallery_media'
  ])->middleware('admin', 'sufficientPermission');

  Route::get('post/gallery/{id}/media/{gallery}', [
    'uses' => 'Gallery\GalleryController@galleryMediaUpdate',
    'as'   => 'admin.gallery_media_update'
  ])->middleware('admin', 'sufficientPermission');


});

Route::group(['prefix' => 'bakpau982'], function () {
  Route::post('user/create', [
    'uses' => 'User\UserController@saveUser',
    'as'   => 'admin.save_user_create'
  ]);
  Route::post('user/update/{slug}', [
    'uses' => 'User\UserController@saveUser',
    'as'   => 'admin.save_user_update'
  ]);
  Route::post('post/create', [
    'uses' => 'Post\PostController@savePost',
    'as'   => 'admin.save_post_create'
  ]);
  Route::post('post/update/{id}', [
    'uses' => 'Post\PostController@savePost',
    'as'   => 'admin.save_post_update'
  ]);
  Route::post('post/category/{id}', [
    'uses' => 'Post\PostController@saveCategory',
    'as'   => 'admin.save_category'
  ]);
  Route::post('post/tag/{id}', [
    'uses' => 'Post\PostController@saveTag',
    'as'   => 'admin.save_tag'
  ]);
  Route::post('banner/{id}', [
    'uses' => 'Banner\BannerController@saveBanner',
    'as'   => 'admin.save_banner'
  ]);
  Route::post('page/{id}', [
    'uses' => 'Page\PageController@savePage',
    'as'   => 'admin.save_page'
  ]);
  Route::post('post/gallery/{id}', [
    'uses' => 'Gallery\GalleryController@saveGallery',
    'as'   => 'admin.save_gallery'
  ]);
  Route::post('post/gallery/{id}/media/{gallery}', [
    'uses' => 'Gallery\GalleryController@saveGalleryMedia',
    'as'   => 'admin.save_gallery_media'
  ]);
  
});

//admin ajax post route
Route::post('/ajax/add-cat', [
  'uses' => 'Ajax\AjaxController@saveCategoriesDetails',
  'as'   => 'save-categories-details'
]);

Route::post('/ajax/add-tag', [
  'uses' => 'Ajax\AjaxController@saveTagsDetails',
  'as'   => 'save-tags-details'
]);

Route::post('/ajax/add-banner', [
  'uses' => 'Ajax\AjaxController@saveBannerDetails',
  'as'   => 'save-Banner-details'
]);

Route::post('/ajax/add-page', [
  'uses' => 'Ajax\AjaxController@savePageDetails',
  'as'   => 'save-page-details'
]);

Route::post('/ajax/add-param', [
  'uses' => 'Ajax\AjaxController@saveParamDetails',
  'as'   => 'save-param-details'
]);

Route::post('/ajax/delete-item', [
  'uses' => 'Ajax\AjaxController@selectedItemDeleteById',
  'as'   => 'selected-item-delete'
]);

Route::post('/ajax/edit-data', [
  'uses' => 'Ajax\AjaxController@getSpecificDetailsById',
  'as'   => 'get-specific-details'
]);

//admin upload product related image route
Route::post('/upload/cms-related-image', [
  'uses' => 'Ajax\AjaxController@saveRelatedImage',
  'as'   => 'save-product-image'
]);

Route::post('/upload/cms-all-image', [
  'uses' => 'Ajax\AjaxController@saveAllImage',
  'as'   => 'save-all-image'
]);

Route::post('/upload/cms-related-video', [
  'uses' => 'Ajax\AjaxController@saveRelatedVideo',
  'as'   => 'save-product-video'
]);

Route::post('/upload/cms-banner-image', [
  'uses' => 'Ajax\AjaxController@saveImageBanner',
  'as'   => 'save-banner-image'
]);

Route::post('/ajax/change-item', [
  'uses' => 'Ajax\AjaxController@changeItem',
  'as'   => 'change-item'
]);

Route::post('/ajax/save-ajax-tag', [
  'uses' => 'Post\PostController@saveAjaxTag',
  'as'   => 'save-ajax-tag'
]);

Route::get('/auto-published-by-schedule-date', [
  'uses' => 'Post\PostController@autopublishedbyscheduledate',
  'as'   => 'auto-published-by-schedule-date'
]);

Route::get('/ajax/notification-apps', [
  'uses' => 'Ajax\AjaxController@notificationapps',
  'as'   => 'notificationapps'
]);

