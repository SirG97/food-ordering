<?php


namespace App\Controllers;

use App\Classes\CSRFToken;
use App\Classes\Random;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Resize;
use App\Classes\Session;
use App\Classes\Validation;
use App\Models\Customer;
use App\Models\Order;

class CustomerController extends BaseController{
    public function getLogin(){
        return view('customer.authenticate');
    }

    public function login(){
        if(Request::has('post')){
            $request = Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token)){

                $rules = [
                    'email' => ['required' => true, 'email' => true],
                    'password' => ['required' => true,'maxLength' => 40]

                ];
                $validation = new Validation();
                $validation->validate($_POST, $rules);
                if($validation->hasError()){
                    $errors = $validation->getErrorMessages();

                    return view('customer.authenticate', ['errors' => $errors]);
                }

                $customer = Customer::where('email', $request->email)->first();
                if($customer){

                    if(!password_verify($request->password, $customer->password)){
                        Session::add('error', 'incorrect password');
                        return view('customer.authenticate');
                    }else{
                        Session::add('SESSION_USER_ID', $customer->user_id);
                        Session::add('SESSION_USERNAME', $customer->email);

                        Redirect::to('/customer/orders');
                    }
                }else{
                    Session::add('error', 'Invalid credentials');
                    return view('customer.authenticate');
                }

//                Session::add('success', 'user created successfully');
                Session::add('error', 'An error occurred');
                return view('customer.authenticate');

            }

            throw new \Exception('Token mismatch');
        }

    }

    public function getRegister(){

        return view('customer.register', ['success' => '','errors' => []]);
    }

    public function register(){
        if(Request::has('post')){
            $request = Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token)){

                $rules = [
                    'email' => ['required' => true, 'maxLength' => 20, 'email' => true, 'unique' =>'customers'],
                    'firstname' => ['required' => true, 'maxLength' => 40, 'string' => true],
                    'surname' => ['string' => true, 'maxLength' => 40],
                    'phone' => ['number' => true, 'maxLength' => 14],
                    'password' => ['required' => true,'maxLength' => 40, 'minLength' => 6],
                    'cpassword' => ['confirmed' => $request->password]
                ];
                $validation = new Validation();
                $validation->validate($_POST, $rules);
                if($validation->hasError()){
                    $errors = $validation->getErrorMessages();
                    return view('customer.register', ['errors' => $errors]);
                }

                //Add the user
                Customer::create([
                    'user_id' => Random::generateId(16),
                    'surname' => $request->surname,
                    'firstname' => $request->firstname,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => password_hash($request->password, PASSWORD_BCRYPT)
                ]);

                Request::refresh();
                Session::add('success', 'user created successfully');
                Redirect::to('/customer/login');

            }

            throw new \Exception('Token mismatch');
        }

    }

    public function showOrders(){
        $orders = Order::where('user_id', Session::get('user_id'))->get();
        return view('customer.orders', ['orders' => $orders]);
    }

    public function showProfile(){
        $orders = Order::where('user_id', Session::get('user_id'))->get();
        return view('customer.profile', ['orders' => $orders]);
    }

    public function showVendors(){
        $orders = Order::where('user_id', Session::get('user_id'))->get();
        return view('customer.recentvendors', ['orders' => $orders]);
    }

    public function showReviews(){
        $orders = Order::where('user_id', Session::get('user_id'))->get();
        return view('customer.review', ['orders' => $orders]);
    }

    public function showAddress(){
        $orders = Order::where('user_id', Session::get('user_id'))->get();
        return view('customer.address', ['orders' => $orders]);
    }

    public function showSettings(){
        $orders = Order::where('user_id', Session::get('user_id'))->get();
        return view('customer.settings', ['orders' => $orders]);
    }

    public function showResetPassword(){
        $orders = Order::where('user_id', Session::get('user_id'))->get();
        return view('customer.password', ['orders' => $orders]);
    }
}