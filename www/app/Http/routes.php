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
        'as' => 'category_index',
        'uses' => 'PrsoCategoryController@index'
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

});

Route::group(['middleware' => ['web', 'auth']], function () {

    Route::get('/account', [
        'as' => 'account_index',
        'uses' => 'Account\AccountController@index'
    ]);

    Route::get('/settings', [
        'as' => 'settings_index',
        'uses' => 'Account\SettingsController@index'
    ]);

    Route::get('/reviews', [
        'as' => 'reviews_index',
        'uses' => 'Account\ReviewsController@index'
    ]);

    Route::post('/account/upload/logo',[
        'as' => 'upload_logo',
        'uses' => 'Account\ImageController@postUploadLogo'
    ]);

    Route::post('/account/update/socials',[
        'as' => 'update_socials',
        'uses' => 'Account\SettingsController@postUpdateSocials'
    ]);
    Route::post('/account/update/main',[
        'as' => 'update_main_settings',
        'uses' => 'Account\SettingsController@postUpdateMainSettings'
    ]);
    Route::post('/account/update/contacts',[
        'as' => 'update_contacts',
        'uses' => 'Account\SettingsController@postUpdateContacts'
    ]);
});


