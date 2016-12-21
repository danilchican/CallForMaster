<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['admin_group'], 'prefix' => 'admin'], function () {

    Route::get('/', [
        'as' => 'adminpanel_index',
        'uses' => 'Admin\AdminController@index'
    ]);

    Route::get('/companies', [
        'as' => 'companies_index',
        'uses' => 'Admin\CompaniesController@index'
    ]);

    Route::get('/companies/new', [
        'as' => 'companies_new',
        'uses' => 'Admin\CompaniesController@newCompanies'
    ]);

    Route::get('/categories', [
        'as' => 'admin.categories.index',
        'uses' => 'PrsoCategoryController@index'
    ]);

    Route::resource('tariffs', 'Admin\TariffsController');

    Route::get('/specializations', [
        'as' => 'admin.specialization.index',
        'uses' => 'SpecializationsController@index'
    ]);

    Route::post('/specializations/create', [
        'as' => 'admin.specialization.create',
        'uses' => 'SpecializationsController@create'
    ]);

    Route::post('/specializations/delete', [
        'as' => 'admin.specialization.delete',
        'uses' => 'SpecializationsController@delete'
    ]);

    Route::post('/specializations/edit', [
        'as' => 'admin.specialization.edit',
        'uses' => 'SpecializationsController@edit'
    ]);

    Route::post('/specializations/update', [
        'as' => 'admin.specialization.update',
        'uses' => 'SpecializationsController@update'
    ]);

    Route::post('/categories/create', [
        'as' => 'category.create',
        'uses' => 'PrsoCategoryController@create'
    ]);

    Route::post('/categories/delete', [
        'as' => 'category.delete',
        'uses' => 'PrsoCategoryController@delete'
    ]);

    Route::post('/categories/edit', [
        'as' => 'category.edit',
        'uses' => 'PrsoCategoryController@edit'
    ]);

    Route::post('/categories/update', [
        'as' => 'category.update',
        'uses' => 'PrsoCategoryController@update'
    ]);

    Route::get('/categories/search/{query}', [
        'as' => 'category.search',
        'uses' => 'PrsoCategoryController@search'
    ]);

});

Route::group(['middleware' => ['web']], function () {

    Route::get('/', 'HomeController@index');

    Route::auth();

    Route::get('/companies', [
        'as' => 'companies.index',
        'uses' => 'CompaniesController@index'
    ]);

    Route::get('/companies/{id}', [
        'as' => 'companies.cart',
        'uses' => 'CompaniesController@cart'
    ])->where('id', '[0-9]+');

    Route::post('/reviews/create', [
        'as' => 'reviews.create',
        'uses' => 'ReviewsController@create'
    ]);
});

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'account'], function () {

    Route::get('/', [
        'as' => 'account_index',
        'uses' => 'Account\AccountController@index'
    ]);

    Route::get('/settings', [
        'as' => 'settings_index',
        'uses' => 'Account\SettingsController@index'
    ]);

    Route::get('/albums', [
        'as' => 'albums.index',
        'uses' => 'Account\AlbumsController@index'
    ]);

    Route::post('/albums/create', [
        'as' => 'albums.create',
        'uses' => 'Account\AlbumsController@create'
    ]);

    Route::post('/albums/delete', [
        'as' => 'albums.delete',
        'uses' => 'Account\AlbumsController@delete'
    ]);

    Route::get('/albums/{id}/view', [
        'as' => 'albums.view',
        'uses' => 'Account\AlbumsController@view'
    ])->where('id', '[0-9]+');

    Route::post('/photo/upload', 'Account\AlbumsPhotoController@create');

    Route::post('/photo/delete', [
        'as' => 'photo.delete',
        'uses' => 'Account\AlbumsPhotoController@delete'
    ]);

    Route::get('/reviews', [
        'as' => 'reviews_index',
        'uses' => 'Account\ReviewsController@index'
    ]);

    Route::post('/upload/logo',[
        'as' => 'upload_logo',
        'uses' => 'Account\ImageController@postUploadLogo'
    ]);

    Route::post('/update/socials',[
        'as' => 'update.socials',
        'uses' => 'Account\SettingsController@postUpdateSocials'
    ]);

    Route::post('/update/main',[
        'as' => 'update.main.settings',
        'uses' => 'Account\SettingsController@postUpdateMainSettings'
    ]);

    Route::post('/update/contacts',[
        'as' => 'update.contacts',
        'uses' => 'Account\SettingsController@postUpdateContacts'
    ]);

    Route::post('/update/specials',[
        'as' => 'update.specials',
        'uses' => 'SpecializationsController@updateSpecialsRelations'
    ]);

    Route::post('/phone/create',[
        'as' => 'account.phone.create',
        'uses' => 'Account\SettingsController@phoneCreate'
    ]);

    Route::post('/phone/delete',[
        'as' => 'account.phone.delete',
        'uses' => 'Account\SettingsController@phoneDelete'
    ]);
    Route::post('/phone/update',[
        'as' => 'account.phone.update',
        'uses' => 'Account\SettingsController@phoneUpdate'
    ]);

    Route::get('/work/types', [
        'as' => 'work.types.index',
        'uses' => 'Account\WorkController@indexTypes'
    ]);

    Route::post('/work/update', [
        'as' => 'work.types.update',
        'uses' => 'Account\WorkController@update'
    ]);

    Route::get('/specializations', [
        'as' => 'account.specializations.index',
        'uses' => 'SpecializationsController@indexAccount'
    ]);

    Route::get('/rise', [
        'as' => 'rise.index',
        'uses' => 'Account\RiseController@index'
    ]);
});

Route::group(['middleware' => ['web']], function () {
    Route::get('/{category}', [
        'as' => 'categories.show',
        'uses' => 'CategoriesController@show'
    ]);
});
