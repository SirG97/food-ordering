<?php

namespace App\Controllers;
use App\Classes\CSRFToken;
use App\Classes\Mail;
use App\Classes\Redirect;
use App\Classes\Session;
use App\Models\Notification;
use App\Models\Customer;

class NotificationController extends BaseController{
//801747fa81efefdf95f3f8c33fcff75e
    public function get(){

        $notifications = Notification::where('customer_id', Session::get('SESSION_USER_ID'))->orderBy('id', 'desc')->get();

        return view('customer.notification', ['notifications' => $notifications]);
    }


}