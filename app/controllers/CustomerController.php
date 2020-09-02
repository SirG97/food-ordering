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
use App\Models\Food;
use App\Models\Vendor;

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

    public function makePayment(){
        
            $result = array();
            $cartTotal = 0;
            if(!Session::has('user_cart') || count(Session::get('user_cart')) < 1){
                echo json_encode(['error' => 'Cart is empty']);
                exit();
            }

            $index = 0;
            $vendor_id = '';
            foreach($_SESSION['user_cart'] as $cartItem){
                $food_id = $cartItem['food_id'];
                $quantity = $cartItem['quantity'];
                $item = Food::where('food_id', $food_id)->first();
                if(!$item){ continue; }

                $totalPrice = (int)$item->unit_price * $quantity;
                $vendor_id = $item->vendor_id;
                $cartTotal = $totalPrice + $cartTotal;
               

                
                $index++;
            }
            $rawTotal = $cartTotal;
            $delivery_fee = Vendor::where('vendor_id', $vendor_id)->first()->min_delivery;
            $rawTotal = (int)$rawTotal + (int)$delivery_fee;

            $curl = curl_init();

            $customer_email = user()->email;
            $amount = $rawTotal;  
            $currency = "NGN";
            $txref = Random::generateId(16); // ensure you generate unique references per transaction.
            $PBFPubKey = 'FLWPUBK_TEST-3a80be255ed958c1974cd2285251956f-X'; // get your public key from the dashboard.
            $redirect_url = "http://localhost:4000/verifypayment/{$txref}";


            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'amount'=>$amount,
                'customer_email'=>$customer_email,
                'currency'=>$currency,
                'txref'=>$txref,
                'PBFPubKey'=>$PBFPubKey,
                'redirect_url'=>$redirect_url,
            
            ]),
            CURLOPT_HTTPHEADER => [
                "content-type: application/json",
                "cache-control: no-cache"
            ],
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            if($err){
            // there was an error contacting the rave API
            die('Curl returned error: ' . $err);
            }

            $transaction = json_decode($response);
            
            if(!$transaction->data && !$transaction->data->link){
            // there was an error from the API
            print_r('API returned error: ' . $transaction->message);
            }

            // uncomment out this line if you want to redirect the user to the payment page
            //print_r($transaction->data->message);


            // redirect to page so User can pay
            // uncomment this line to allow the user redirect to the payment page
            header('Location: ' . $transaction->data->link);

            
        
    }

    public function verifyTransaction($id){
        $id = $id['txref'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/{$id}/verify",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization: Bearer FLWSECK_TEST-e3fdf45b85e810308d36def3d0b52541-X"
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        dd($response);
    }

    
}