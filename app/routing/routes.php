<?php

require_once __DIR__.'/../../vendor/altorouter/altorouter/AltoRouter.php';


$router = new Altorouter();
$_ = '\App\Controllers\\';

$router->map('GET', '/', $_ .'IndexController@index', 'home');
$router->map('GET', '/restaurants', $_ .'IndexController@restaurants', 'restaurants');
$router->map('GET', '/restaurant', $_ .'IndexController@restaurant', 'restaurant');
$router->map('GET', '/revieworder', $_ .'IndexController@revieworder', 'review_order');



$router->map('GET', '/vendor/register', $_ .'VendorController@create', 'createVendor');
$router->map('POST', '/vendor/register', $_ .'VendorController@store', 'storeVendor');
$router->map('GET', '/vendors', $_ .'VendorController@index', 'allVendors');
$router->map('GET', '/vendor/[:id]', $_ .'VendorController@show', 'showVendor');
$router->map('GET', '/vendor/[:id]/edit', $_ .'VendorController@edit', 'editVendor');
$router->map('POST', '/vendor/[:id]/update', $_ .'VendorController@update', 'updateVendor');


$router->map('POST', '/foodcategory/create', $_ .'CategoryController@store', 'storeFoodCategory');
$router->map('POST', '/foodcategory/[:id]/edit', $_ .'CategoryController@edit', 'editFoodCategory');
$router->map('POST', '/food/create', $_ .'FoodController@store', 'storeFood');



//Authenticated routes

$router->map('GET', '/register', $_ .'AuthController@showregister', 'show_register');
$router->map('POST', '/register', $_ .'AuthController@register', 'register_user');

// Authentication and login
$router->map('GET', '/login', $_ .'AuthController@show', 'login');
$router->map('POST', '/login', $_ .'AuthController@login', 'auth');
$router->map('GET', '/logout', $_ .'AuthController@logout', 'logout');

// Dashboard
$router->map('GET', '/dashboard', $_ .'DashboardController@show', 'dashboard');
$router->map('POST', '/dashboard', $_ .'DashboardController@store', 'dt');


// Staff routes
$router->map('GET', '/profile', '\App\Controllers\UserController@view_profile', 'profile');
$router->map('GET', '/managers', '\App\Controllers\UserController@get_managers', 'managers');
$router->map('GET', '/manager/[:staff_id]', '\App\Controllers\UserController@get_staff', 'get_manager');

$router->map('GET', '/riders', '\App\Controllers\UserController@get_riders', 'riders');
$router->map('GET', '/rider/[:staff_id]', '\App\Controllers\UserController@get_staff', 'get_rider');
$router->map('GET', '/staff', '\App\Controllers\UserController@new_staff_form', 'new_staff_form');
$router->map('POST', '/staff/add', '\App\Controllers\UserController@store_staff', 'store_staff');
$router->map('POST', '/staff/[:user_id]/edit', '\App\Controllers\UserController@edit_staff', 'edit_staff');
$router->map('POST', '/staff/[:user_id]/delete', '\App\Controllers\UserController@delete_staff', 'delete_staff');

//FoodCategory and route routes
$router->map('GET', '/district_routes', '\App\Controllers\DistrictController@get_district', 'district');
$router->map('POST', '/district/create', '\App\Controllers\DistrictController@store_district', 'store_district');
$router->map('POST', '/route/create', '\App\Controllers\DistrictController@store_route', 'store_route');
$router->map('GET', '/assign_routes', '\App\Controllers\DeliveryController@get_assign_route', 'get_assign_route');
$router->map('GET', '/assign_routes/[:district_id]', '\App\Controllers\DeliveryController@get_rider_district', 'rider_district');
$router->map('POST', '/route/assign', '\App\Controllers\DeliveryController@assign_route', 'assign_route');
$router->map('POST', '/assigned_routes/[:rider_id]/delete', '\App\Controllers\DeliveryController@delete_assigned_route', 'delete_assigned_route');

$router->map('POST', '/route/[:route_id]/edit', '\App\Controllers\DistrictController@edit_route', 'edit_route');
$router->map('POST', '/route/[:route_id]/delete', '\App\Controllers\DistrictController@delete_route', 'delete_route');


//Order Routes
$router->map('GET', '/orders', '\App\Controllers\OrderController@show_orders', 'orders');
$router->map('GET', '/create_order', '\App\Controllers\OrderController@get_order_form', 'order_form');
$router->map('GET', '/routes/[:district_id]', '\App\Controllers\OrderController@get_routes', 'get_routes');
$router->map('POST', '/save_order', '\App\Controllers\OrderController@save_order', 'save_order');
$router->map('GET', '/order/[:order_no]', '\App\Controllers\OrderController@get_order', 'get_order');
$router->map('POST', '/order/[:order_no]/edit', '\App\Controllers\OrderController@edit_order', 'edit_order');
$router->map('POST', '/order/[:order_no]/delete', '\App\Controllers\OrderController@delete_order', 'delete_order');
$router->map('GET', '/pot', '\App\Controllers\OrderController@pot', 'pot');
$router->map('GET', '/orders/[:terms]/search', '\App\Controllers\OrderController@search_orders', 'search_orders');


//$router->map('GET', '/customer/[:contribution_id]', '\App\Controllers\CustomerController@getcontribution', 'get_contribution');
$router->map('POST', '/customer/[:customer_id]/edit', '\App\Controllers\CustomerController@editcustomer', 'edit_customer');

// Settings
$router->map('GET', '/settings', '\App\Controllers\SettingsController@showSettings', 'show_settings');
$router->map('POST', '/settings', '\App\Controllers\SettngsController@settings', 'settings');

//Access Denied and error page
$router->map('GET', '/unauthorized', '\App\Controllers\BaseController@access_denied', 'access_denied');


