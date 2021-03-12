<?php
Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function(){ 
Route::prefix('dashbord')->name('dashbord.')->middleware(['auth'])->group(function(){
Route::get('/','WelcomeController@index')->name('welcome');
//route users
Route::resource('user','UserController')->except(['show']);
//route categries
Route::resource('categories','CategoryController')->except(['show']);
//route products
Route::resource('products','Productcontroller')->except(['show']);
//route client
Route::resource('clients','Clientcotroller')->except(['show']);
Route::resource('clients.orders','client\OrderController')->except(['show']);
//oreds
Route::resource('orders','OrderController')->except(['show']);
Route::get('/orders/{order}/products','OrderController@products')->name('orders.products');



});//end of dashbord
});//end of LaravelLocalization

?>
