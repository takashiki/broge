<?php

Auth::routes();
Route::feeds();

// Tag
Route::group(['prefix' => 'tag', 'as' => 'tag.'], function () {
    Route::get('/', 'TagController@index')->name('list');
    Route::get('/{tag}', 'TagController@show')->name('show');
});

// Site
Route::get('/search', 'SiteController@search')->name('search');
Route::get('/archives', 'SiteController@archives')->name('archives');

// SiteMap
Route::get('sitemap', 'SiteController@sitemap')->name('sitemap');
Route::get('sitemap.xml', 'SiteController@sitemap')->name('sitemap.xml');

// Article
Route::get('/', 'ArticleController@index')->name('article.list');
Route::get('/archives/{identity}', 'ArticleController@show')->name('typecho.article.show');
Route::get('/article/{identity}', 'ArticleController@show')->name('article.show');

// Upload
Route::post('/upload', 'UploadController@upload');

// Page
Route::get('/{slug}', 'PageController@show')->name('page');
