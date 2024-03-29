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

Route::get('/users/{id}', function ($id){
    return 'This is user ' .$id;
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users/{id}/{name}', function ($id, $name){
    return 'This is user ' .$name.' with an ID of '.$id;
});

Route::get('/about', function () {
    return view('pages.about');
    return view('pages/about'); is also acceptable
});
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/add_to_cart{id}',[
    'uses' => 'ProductsController@getAddToCart',
    'as' => 'product.addToCart'
]);
Route::get('/remove_from_cart{id}',[
    'uses' => 'ProductsController@removeFromCart',
    'as' => 'product.removeFromCart'
]);

Route::get('/shopping-cart',[
    'uses' => 'ProductsController@getCart',
    'as' => 'product.shoppingCart'
]);

Route::get('/checkout',[
    'uses' => 'ProductsController@getCheckout',
    'as' => 'checkout'
]);

Route::post('/checkout',[
    'uses' => 'ProductsController@postCheckout',
    'as' => 'checkout'
]);

// Show payment form
Route::get('/payment/add-funds/paypal', 'PaypalController@showForm');

// Post payment details for store/process API request
Route::post('/payment/add-funds/paypal', 'PaypalController@store');

// Handle status
Route::get('/payment/add-funds/paypal/status', 'PaypalController@getPaymentStatus');

//Route::post('/dashboard','UserController@update_profile');
//Route::get('/dashboard','UserController@dashboard');
Route::get('pages.about', 'PagesController@about');
Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'ServicesController@index');
Route::resource('posts', 'PostsController');
Route::resource('pets', 'PetsController');
Route::resource('products', 'ProductsController');
//Route::resource('users', 'UserController');
Auth::routes();
Route::get('/dashboard', 'DashboardController@index');
Route::post('/dashboard','DashboardController@update');

Route::prefix('admin')->group(function(){
  Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
  Route::get('/users', 'AdminController@showUsers')->name('admin.users');
  Route::get('/users/{id}', 'AdminController@showUser')->name('admin.user');
  Route::delete('/users/{id}', 'AdminController@destroyUser')->name('admin.users.delete');
  Route::get('/products', 'AdminController@showProducts')->name('admin.products');
  Route::get('/products/{id}', 'AdminController@showProduct')->name('admin.product');
  Route::get('/orders', 'AdminController@showOrders')->name('admin.orders');
  Route::get('/orders/{id}', 'AdminController@showOrder')->name('admin.order');
  Route::get('/products/{id}/edit', 'ProductsController@edit')->name('admin.product.edit');
  //Route::post('/products/{id}', 'AdminController@updateProducts')->name('admin.products.update');
  Route::delete('/products/{id}', 'AdminController@destroyProduct')->name('admin.products.delete');
  Route::get('/','AdminController@index')->name('admin.dashboard');
  Route::post('/','AdminController@update')->name('admin.dashboard.update');
});
