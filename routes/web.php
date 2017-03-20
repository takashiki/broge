<?php

Route::feeds();

// Tag
Route::group(['prefix' => 'tag'], function () {
    Route::get('/', 'TagController@index');
    Route::get('/{tag}', 'TagController@show');
});

// Site
Route::get('/search', 'SiteController@search');
Route::get('/archives', 'SiteController@archives');

// SiteMap
Route::get('sitemap', 'HelperController@sitemap');
Route::get('sitemap.xml', 'HelperController@sitemap');

// Feed
Route::get('feed', 'HelperController@feed');

// Article
Route::get('/', 'ArticleController@index');
Route::get('/archives/{identity}', 'ArticleController@show');
Route::get('/article/{identity}', 'ArticleController@show');

// Page
Route::get('/{slug}', 'PageController@show');
