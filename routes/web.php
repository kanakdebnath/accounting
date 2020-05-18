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
Route::group(['middleware' => ['install']], function () {
	Route::get('/', function () {
		return view('welcome');
	});
	Auth::routes();
	Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'admin', 'middleware' => ['auth']], function () {
		Route::match(['get', 'post'], 'configuration', 'SettingController@index')->name('configuration');
		Route::post('/logo', 'SettingController@upload_logo')->name('logo');
		Route::post('/api', 'SettingController@api')->name('api');
		Route::post('/social', 'SettingController@api')->name('social');

		/*::::::::::::::::::Profile:::::::::::::::::::::*/
		Route::get('/profile', 'SettingController@profile')->name('profile');
		Route::post('/profile/update', 'SettingController@profile_update')->name('profile.update');

		
		/*::::::::::::::::::language:::::::::::::::::::::*/
		Route::get('/language', 'LanguageController@index')->name('language');
		Route::match(['get', 'post'], 'create', 'LanguageController@create')->name('language.create');
		Route::get('language/edit/{id?}', 'LanguageController@edit')->name('language.edit');
		Route::patch('language/update/{id}', 'LanguageController@update')->name('language.update');
		Route::delete('/language/delete/{id}', 'LanguageController@delete')->name('language.delete');
		/*::::::::::::::user role Permission:::::::::*/
		Route::group(['as' => 'user.', 'prefix' => 'user'], function () {
			Route::get('/role', 'RoleController@index')->name('role');
			Route::get('/role/datatable', 'RoleController@datatable')->name('role.datatable');
			Route::any('/role/create', 'RoleController@create')->name('role.create');
			Route::get('/role/edit/{id}', 'RoleController@edit')->name('role.edit');
			Route::post('/role/edit', 'RoleController@update')->name('role.update');
			Route::delete('/role/delete/{id}', 'RoleController@distroy')->name('role.delete');
			//user:::::::::::::::::::::::::::::::::
			Route::get('/', 'UserController@index')->name('index');
			Route::any('/create', 'UserController@create')->name('create');
			Route::put('/change/{value}/{id}', 'UserController@status')->name('change');
			Route::get('/edit/{id}', 'UserController@edit')->name('edit');
			Route::put('/edit', 'UserController@update')->name('update');
			Route::delete('/delete/{id}', 'UserController@destroy')->name('delete');

		});
	});
});

/*::::::::::::::::::::install::::::::::::::::::*/
Route::get('/install', 'Install\InstallController@index')->name('install');
Route::post('/install', 'Install\InstallController@terms');
Route::get('/install/server', 'Install\InstallController@server')->name('install.server');
Route::post('/install/server', 'Install\InstallController@check_server');
Route::get('install/database', 'Install\InstallController@database')->name('install.database');
Route::post('install/database', 'Install\InstallController@process_install');
Route::get('install/user', 'Install\InstallController@create_user')->name('install.user');
Route::post('install/user', 'Install\InstallController@store_user');
Route::get('install/settings', 'Install\InstallController@system_settings')->name('install.settings');
Route::post('install/settings', 'Install\InstallController@final_touch');

Route::get('/home', 'HomeController@index')->name('home');
