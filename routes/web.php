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
Auth::routes();

Route::get('/', 'ClientHomeController@index')->name('clientHome');

Route::match(["GET", "POST"], "/register", function(){
    return redirect("/login");
})->name("register");

Route::group(['prefix' => '/c'], function() {
    Route::get('/sakip', 'ClientSakipController@index')->name('clientSakip');
    Route::get('/tentang-sakip', 'ClientTentangSakipController@index')->name('clientTentangSakip');
    Route::get('/berita', 'ClientBeritaController@index')->name('clientBerita');
    Route::get('/gallery', 'ClientGalleryController@index')->name('clientGallery');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('users', 'UserController');
    Route::resource('berita', 'BeritaController');
    Route::resource('gallery', 'GalleryController');
    Route::resource('opd', 'OpdController');
    Route::resource('jabatan-opd', 'JabatanOpdController');
});





// Route::get('/home', 'ClientHomeController@index')->name('clientHome');
