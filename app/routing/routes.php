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

// Cart Route
$router->map('GET', '/cart', $_ .'IndexController@reviewOrder', 'getCart');
$router->map('POST', '/cart/add', $_ .'CartController@addItem', 'addToCart');
$router->map('POST', '/cart/update', $_ .'CartController@updateQuantity', 'updateQuantity');
$router->map('POST', '/cart/remove', $_ .'CartController@removeItem', 'removeItem');
$router->map('GET', '/items', $_ .'CartController@getCartItems', 'getCartItem');



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



// Authentication and login for admin
$router->map('GET', '/admin/login', $_ .'AuthController@show', 'a_login');
$router->map('POST', '/admin/login', $_ .'AuthController@login', 'a_auth');
$router->map('GET', '/logout', $_ .'AuthController@logout', 'logout');

// Dashboard
$router->map('GET', '/dashboard', $_ .'DashboardController@show', 'dashboard');
$router->map('POST', '/dashboard', $_ .'DashboardController@store', 'dt');


$router->map('GET', '/customer/orders', $_ .'CustomerController@showOrders', 'customerOrders');
$router->map('GET', '/order/[:order_id]', $_ .'CustomerController@showOrder', 'customerOrder');

$router->map('POST', '/verifytransaction', $_ .'CustomerController@verifyTransaction', 'verifyTransaction');
$router->map('GET', '/confirmation', $_ .'CustomerController@confirmOrder', 'confirmOrder');
$router->map('GET', '/customer/notifications', $_ .'CustomerController@notifications', 'Notifications');
$router->map('GET', '/customer/account', $_ .'CustomerController@showAccount', 'customerAccount');
$router->map('GET', '/customer/vendors', $_ .'CustomerController@showVendors', 'customerVendors');
$router->map('GET', '/customer/address', $_ .'CustomerController@showAddress', 'customerAddress');
$router->map('GET', '/customer/reviews', $_ .'ReviewController@showReviews', 'customerReviews');
$router->map('POST', '/review/save', $_ .'ReviewController@saveReview', 'saveCustomerReview');
$router->map('GET', '/customer/settings', $_ .'CustomerController@showSettings', 'customerSettings');
$router->map('GET', '/customer/resetpassword', $_ .'CustomerController@showResetPassword', 'customerResetPassword');

$router->map('GET', '/customer', $_ .'CustomerController@showProfile', 'customer');
$router->map('GET', '/customer/login', $_ .'CustomerController@getLogin', 'getLogin');
$router->map('GET', '/login', $_ .'CustomerController@getLogin', 'Login');
$router->map('POST', '/customer/login', $_ .'CustomerController@login', 'customerLogin');
$router->map('GET', '/customer/logout', $_ .'CustomerController@logout', 'customerLogout');
$router->map('GET', '/customer/register', $_ .'CustomerController@getRegister', 'getRegister');
$router->map('POST', '/customer/register', $_ .'CustomerController@register', 'CustomerRegister');

$router->map('GET', '/register', $_ .'CustomerController@getRegister', 'show_register');
$router->map('POST', '/register', $_ .'CustomerController@register', 'register_user');




//New UI implementation


$router->map('GET', '/home', $_ .'IndexController@home', 'homep');
$router->map('GET', '/newrs', $_ .'IndexController@newrs', 'newrs');
$router->map('GET', '/newr/[:uid]', $_ .'IndexController@newr', 'newr');
$router->map('GET', '/newro', $_ .'IndexController@newro', 'newRo');





