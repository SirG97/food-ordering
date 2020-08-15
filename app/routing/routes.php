<?php

require_once __DIR__.'/../../vendor/altorouter/altorouter/AltoRouter.php';


$router = new Altorouter();
$_ = '\App\Controllers\\';

$router->map('GET', '/', $_ .'IndexController@index', 'home');
$router->map('GET', '/restaurants', $_ .'IndexController@restaurants', 'restaurants');
$router->map('GET', '/restaurant/[:uid]', $_ .'IndexController@restaurant', 'restaurant');
$router->map('GET', '/revieworder', $_ .'IndexController@revieworder', 'review_order');

//Vue Restaurant route
$router->map('GET', '/menu/[:uid]', $_ .'IndexController@getMenu', 'getmenu');

$router->map('GET', '/vendor/register', $_ .'VendorController@create', 'createVendor');
$router->map('POST', '/vendor/register', $_ .'VendorController@store', 'storeVendor');
$router->map('GET', '/vendors', $_ .'VendorController@index', 'allVendors');
$router->map('GET', '/vendor/[:uid]', $_ .'VendorController@show', 'showVendor');
$router->map('GET', '/vendor/[:uid]/edit', $_ .'VendorController@edit', 'editVendor');
$router->map('POST', '/vendor/[:uid]/upload', $_ .'VendorController@upload', 'uploadVendorBanner');
$router->map('POST', '/vendor/[:uid]/update', $_ .'VendorController@update', 'updateVendor');
$router->map('POST', '/vendor/[:uid]/delete', $_ .'VendorController@delete', 'deleteVendor');


$router->map('POST', '/foodcategory/create', $_ .'CategoryController@store', 'storeFoodCategory');
$router->map('POST', '/foodcategory/[:id]/edit', $_ .'CategoryController@edit', 'editFoodCategory');
$router->map('POST', '/food/create', $_ .'FoodController@store', 'storeFood');
$router->map('POST', '/food/[:food_id]/edit', $_ .'FoodController@update', 'updateFood');
$router->map('POST', '/food/[:food_id]/delete', $_ .'FoodController@delete', 'deleteFood');



//Authenticated routes

$router->map('GET', '/register', $_ .'AuthController@showregister', 'show_register');
$router->map('POST', '/register', $_ .'AuthController@register', 'register_user');

// Authentication and login for admin
$router->map('GET', '/admin/login', $_ .'AuthController@show', 'login');
$router->map('POST', '/admin/login', $_ .'AuthController@login', 'auth');
$router->map('GET', '/logout', $_ .'AuthController@logout', 'logout');

// Dashboard
$router->map('GET', '/dashboard', $_ .'DashboardController@show', 'dashboard');
$router->map('POST', '/dashboard', $_ .'DashboardController@store', 'dt');


$router->map('GET', '/customer/orders', $_ .'CustomerController@showOrders', 'customerOrders');
$router->map('GET', '/customer/vendors', $_ .'CustomerController@show', 'customerVendors');
$router->map('GET', '/customer/reviews', $_ .'CustomerController@show', 'customerReviews');
$router->map('GET', '/customer/settings', $_ .'CustomerController@show', 'customerSettings');
$router->map('GET', '/customer', $_ .'CustomerController@show', 'customer');
$router->map('GET', '/customer/login', $_ .'CustomerController@getLogin', 'getLogin');
$router->map('POST', '/customer/login', $_ .'CustomerController@login', 'customerLogin');
$router->map('GET', '/customer/register', $_ .'CustomerController@getRegister', 'getRegister');
$router->map('POST', '/customer/register', $_ .'CustomerController@register', 'CustomerRegister');





