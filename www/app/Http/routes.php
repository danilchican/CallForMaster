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

Route::group(['middleware' => ['admin_group']], function () {

    Route::get('/adminpanel', [
        'as' => 'adminpanel_index',
        'uses' => 'Admin\AdminController@index'
    ]);

    Route::get('/adminpanel/companies', [
        'as' => 'companies_index',
        'uses' => 'Admin\CompaniesController@index'
    ]);

    Route::get('/adminpanel/companies/new', [
        'as' => 'companies_new',
        'uses' => 'Admin\CompaniesController@newCompanies'
    ]);

    Route::get('/adminpanel/categories', [
        'as' => 'admin.categories.index',
        'uses' => 'PrsoCategoryController@index'
    ]);

    Route::get('/adminpanel/specializations', [
        'as' => 'admin.specialization.index',
        'uses' => 'SpecializationsController@index'
    ]);

    Route::post('/adminpanel/specializations/create', [
        'as' => 'admin.specialization.create',
        'uses' => 'SpecializationsController@create'
    ]);

    Route::post('/adminpanel/specializations/delete', [
        'as' => 'admin.specialization.delete',
        'uses' => 'SpecializationsController@delete'
    ]);

    Route::post('/adminpanel/specializations/edit', [
        'as' => 'admin.specialization.edit',
        'uses' => 'SpecializationsController@edit'
    ]);

    Route::post('/adminpanel/specializations/update', [
        'as' => 'admin.specialization.update',
        'uses' => 'SpecializationsController@update'
    ]);

    Route::post('/adminpanel/categories/create', [
        'as' => 'category.create',
        'uses' => 'PrsoCategoryController@create'
    ]);

    Route::post('/adminpanel/categories/delete', [
        'as' => 'category.delete',
        'uses' => 'PrsoCategoryController@delete'
    ]);

    Route::post('/adminpanel/categories/edit', [
        'as' => 'category.edit',
        'uses' => 'PrsoCategoryController@edit'
    ]);

    Route::post('/adminpanel/categories/update', [
        'as' => 'category.update',
        'uses' => 'PrsoCategoryController@update'
    ]);

    Route::get('/adminpanel/categories/search/{query}', [
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

    Route::get('/categories/{slug}', [
        'as' => 'categories.index',
        'uses' => 'CategoriesController@index'
    ]);

});

Route::group(['middleware' => ['web', 'auth']], function () {

    Route::get('/account', [
        'as' => 'account_index',
        'uses' => 'Account\AccountController@index'
    ]);

    Route::get('/account/settings', [
        'as' => 'settings_index',
        'uses' => 'Account\SettingsController@index'
    ]);

    Route::get('/account/albums', [
        'as' => 'albums.index',
        'uses' => 'Account\AlbumsController@index'
    ]);

    Route::post('/account/albums/create', [
        'as' => 'albums.create',
        'uses' => 'Account\AlbumsController@create'
    ]);

    Route::post('/account/albums/delete', [
        'as' => 'albums.delete',
        'uses' => 'Account\AlbumsController@delete'
    ]);

    Route::get('/account/albums/{id}/view', [
        'as' => 'albums.view',
        'uses' => 'Account\AlbumsController@view'
    ])->where('id', '[0-9]+');

    Route::post('/account/photo/upload', 'Account\AlbumsPhotoController@create');

    Route::post('/account/photo/delete', [
        'as' => 'photo.delete',
        'uses' => 'Account\AlbumsPhotoController@delete'
    ]);

    Route::get('/account/reviews', [
        'as' => 'reviews_index',
        'uses' => 'Account\ReviewsController@index'
    ]);

    Route::post('/account/upload/logo',[
        'as' => 'upload_logo',
        'uses' => 'Account\ImageController@postUploadLogo'
    ]);

    Route::post('/account/update/socials',[
        'as' => 'update.socials',
        'uses' => 'Account\SettingsController@postUpdateSocials'
    ]);

    Route::post('/account/update/main',[
        'as' => 'update.main.settings',
        'uses' => 'Account\SettingsController@postUpdateMainSettings'
    ]);

    Route::post('/account/update/contacts',[
        'as' => 'update.contacts',
        'uses' => 'Account\SettingsController@postUpdateContacts'
    ]);

    Route::post('/account/update/specials',[
        'as' => 'update.specials',
        'uses' => 'SpecializationsController@updateSpecialsRelations'
    ]);

    Route::post('/account/phone/create',[
        'as' => 'account.phone.create',
        'uses' => 'Account\SettingsController@phoneCreate'
    ]);

    Route::post('/account/phone/delete',[
        'as' => 'account.phone.delete',
        'uses' => 'Account\SettingsController@phoneDelete'
    ]);
    Route::post('/account/phone/update',[
        'as' => 'account.phone.update',
        'uses' => 'Account\SettingsController@phoneUpdate'
    ]);

    Route::get('/account/work/types', [
        'as' => 'work.types.index',
        'uses' => 'Account\WorkController@indexTypes'
    ]);

    Route::post('/account/work/update', [
        'as' => 'work.types.update',
        'uses' => 'Account\WorkController@update'
    ]);

    Route::get('/account/specializations', [
        'as' => 'account.specializations.index',
        'uses' => 'SpecializationsController@indexAccount'
    ]);
});


