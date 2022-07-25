<?php

use Illuminate\Support\Facades\Route;

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
//Frontend Route
route::get('/register', 'FrontendController@showRegisterForm')->name('register');
Route::get('/login', 'FrontendController@showLoginForm')->name('login');
route::post('/register', 'FrontendController@register')->name('submit.register');
Route::post('/login', 'FrontendController@login')->name('submit.login');
Route::get('/logout', 'FrontendController@logout')->name('logout');
Route::get('/cart', 'FrontendController@cart')->name('cart');
route::get('/', 'FrontendController@index')->name('home');
route::get('/collections', 'FrontendController@shop')->name('shop');

route::get('/collections/{slug}','FrontendController@productCat')->name('product-cat');
route::get('/product/{slug}','FrontendController@productDetail')->name('product-detail');
route::post('/product/search','FrontendController@autoSearch')->name('auto-search');
route::get('/search','FrontendController@productSearch')->name('product-search');

//Cart
Route::post('/cart/update', 'CartController@cart')->name('update-cart');
route::post('/cart/store', 'CartController@store')->name('add-cart');
route::delete('/cart/delete', 'CartController@delete')->name('delete-cart');

//backend Route
Route::prefix('admin')->middleware('is_admin')->group(function () {
    //dashboard
    route::get('/', 'AdminController@index')->name('admin');

    //banner route
    route::resource('/banner', 'BannerController');
    route::post('bannerStatus', 'BannerController@status')->name('banner.status');
    //category route
    route::resource('/category', 'CategoryController');
    route::post('categoryStatus', 'CategoryController@status')->name('category.status');

    route::post('getChild', 'CategoryController@getChildByParentId')->name('category.getChild');
    //Brand route
    route::resource('/brand', 'BrandController');
    route::post('brandStatus', 'BrandController@status')->name('brand.status');
    //Product route
    route::resource('/product', 'ProductController');
    route::post('productStatus', 'ProductController@status')->name('product.status');
 });








Route::group(['prefix' => 'laravel-filemanager'], function (){
    \UniSharp\LaravelFilemanager\Lfm::routes();
});