<?php


namespace App\Controllers;

use App\Classes\CSRFToken;
use App\Classes\Random;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Resize;
use App\Classes\Session;
use App\Classes\Validation;
use App\Classes\Cart;
use App\Classes\Mail;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Food;
use App\Models\Vendor;
use App\Models\Payment;
use mysql_xdevapi\Exception;


class CustomerController extends BaseController{
    public function getLogin(){
        if($_SERVER['HTTP_REFERER']){
            Session::add('referer', $_SERVER['HTTP_REFERER']);
        }
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

                        Session::add('SESSION_USER_ID', $customer->customer_id);
                        Session::add('SESSION_USERNAME', $customer->email);

                        if(Session::has('referer')){
                            $url = Session::get('referer');
                            if($url == 'http://localhost:4000/customer/register' or
                                $url =='http://food.ononiru.com/customer/register' or
                                $url =='https://food.ononiru.com/customer/register'){
                                Session::remove('referer');
                                Redirect::to('/');
                            }else{
                                Redirect::to($url);
                            }

                        }else{
                            Redirect::to('/');
                        }
                        
                    }
                }else{
                    Session::add('error', 'Invalid credentials');
                    return view('customer.authenticate');
                }

            //  Session::add('success', 'user created successfully');
            Session::add('error', 'An error occurred');
            return view('customer.authenticate');

            }

            throw new \Exception('Token mismatch');
        }

    }

    public function getRegister(){
        return view('customer.register', ['success' => '','errors' => []]);
    }

    public function showAccount(){
        $customer = Customer::where('customer_id', Session::get('SESSION_USER_ID'))->first();
        $address = Address::where('customer_id', Session::get('SESSION_USER_ID'))->first();

        return view('customer.profile', ['customer' => $customer, 'address' => $address]);

    }

    public function editAccount(){
        if(Request::has('post')){
            $request = Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token)){
                $address = Address::where('customer_id', Session::get('SESSION_USER_ID'))->first();
                $rules = [
                    'customer_id' => ['required' => true,],
                    'firstname' => ['required' => true, 'maxLength' => 40, 'string' => true],
                    'surname' => ['string' => true, 'maxLength' => 40],
                    'phone' => ['number' => true, 'maxLength' => 14],
                    'address' => ['mixed' => true, 'maxLength' => 200],
                    'town' => ['mixed' => true, 'maxLength' => 50],
                    'area' => ['mixed' => true, 'maxLength' => 50],
                ];
                $validation = new Validation();
                $validation->validate($_POST, $rules);
                if($validation->hasError()){
                    $errors = $validation->getErrorMessages();
                    $customer = Customer::where('customer_id', Session::get('SESSION_USER_ID'))->first();
                    $address = Address::where('customer_id', Session::get('SESSION_USER_ID'))->first();
                    return view('customer.profile', ['errors' => $errors, 'customer' => $customer, 'address' => $address]);
                }
                $customer = Customer::findOrFail($request->customer_id);
                $customer->surname = $request->surname;
                $customer->firstname = $request->firstname;
                $customer->phone = $request->phone;

                $address->address = $request->address;
                $address->town = $request->town;
                $address->area = $request->area;
                try{
                   $customer->save();
                   $address->save();
                   Session::add('success', 'Details updated successfully');
                   Redirect::to('/customer/account');

                }catch (\Exception $e){
                   Session::add('error', 'Operation failed');
                   Redirect::to('/customer/account');
                }
            }

            throw new \Exception('Token mismatch');
        }
    }

    public function saveAddress(){
        if(Request::has('post')){
            $request = Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token)){
                $address = Address::where('customer_id', Session::get('SESSION_USER_ID'))->first();
                $rules = [
                    'customer_id' => ['required' => true,],
                    'address' => ['mixed' => true, 'maxLength' => 200],
                    'town' => ['mixed' => true, 'maxLength' => 50],
                    'area' => ['mixed' => true, 'maxLength' => 50],
                ];
                $validation = new Validation();
                $validation->validate($_POST, $rules);
                if($validation->hasError()){
                    $errors = $validation->getErrorMessages();
                    $customer = Customer::where('customer_id', Session::get('SESSION_USER_ID'))->with('addresses')->first();
                    return view('user.revieworder', ['errors' => $errors, 'customer' => $customer]);
                }

                try{
                    Address::create([
                        'address_id' => Random::generateId(16),
                        'customer_id' => $request->customer_id,
                        'address' => $request->address,
                        'town' => $request->town,
                        'area' => $request->area,
                    ]);

                    Request::refresh();
                    Session::add('success', 'Address added successfully');
                    Redirect::back();

                }catch (\Exception $e){
                    Session::add('error', 'Operation failed');
                    Redirect::back();
                }

            }

            throw new \Exception('Token mismatch');
        }
    }

    public function register(){
        if(Request::has('post')){
            $request = Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token)){

                $rules = [
                    'email' => ['required' => true, 'maxLength' => 40, 'email' => true, 'unique' =>'customers'],
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
                    'customer_id' => Random::generateId(16),
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
        
        $orders = Order::where('user_id', Session::get('SESSION_USER_ID'))->with('vendor')->get();
        
        return view('customer.orders', ['orders' => $orders]);
    }

    public function showOrder($id){
        $order_id =  $id['order_id'];
        $order = Order::where('order_id', $order_id)->with(['orderItem.food', 'vendor'])->first();
       
        return view('customer.order', ['order' => $order]);
    }

    public function showProfile(){
        $customer = Customer::where('customer_id', Session::get('SESSION_USER_ID'))->first();
        $address = Address::where('customer_id', Session::get('SESSION_USER_ID'))->first();
        return view('customer.profile', ['customer' => $customer, 'address' => $address]);
    }

    public function showVendors(){
        $order = Order::where('user_id', Session::get('SESSION_USER_ID'))->groupBy('vendor_id')->with('vendor')->get();
        return view('customer.recentvendors', ['orders' => $order]);
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
    }

    public function verifyTransaction(){
        if(Request::has('post')){
            $request = Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token)){
                
                $curl = curl_init();
                $id = $request->transaction_id;
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
                $response = json_decode($response);
                curl_close($curl);

                if($response->status === 'success' and 
                    $response->data->status === 'successful' and 
                    $response->data->amount >= $request->rawTotal and
                    $response->data->currency === "NGN"){
                        $amount = $response->data->amount;
                        $tx_ref = $response->data->tx_ref;
                        $status = $response->data->status;
                        
                   $saveOrder =  self::storePaymentAndOrder($tx_ref, $amount, $status, $request->address);

                   if($saveOrder['status'] == 'success'){
                       Session::add('success', 'Your order has been confirmed and will arrive shortly');
    //                         return view('user.confirmation', ['result' => $saveOrder['data']]);
                          echo json_encode([ 'result' => $saveOrder['data']]);
                          exit;
                        // Redirect::to('/conformation');
                   }else{
                    echo json_encode([ 'result' => $saveOrder]);
                    exit;
                    
                   }
                    
                }
                // echo json_encode(['status' => '', 'response' => $response]);
                // exit;

            }

            throw new \Exception('Token mismatch');
        }


    }

    public function storePaymentAndOrder($tx_ref, $amount, $status, $address){
        try{
            $order_id = strtoupper(uniqid());
            $result['product'] = array();
            $result['order_id'] = $order_id;
            $cartTotal = 0;
            $delivery_fee = 0;
             foreach($_SESSION['user_cart'] as $cartItem){
                 $food_id = $cartItem['food_id'];
                 $quantity = $cartItem['quantity'];
                 $item = Food::where('food_id', $food_id)->first();
                 if(!$item){ continue; }
     
                 $totalPrice = (int)$item->unit_price * $quantity;
                 $vendor_id = $item->vendor_id;
                 $vendor = Vendor::where('vendor_id', $vendor_id)->first();
                 $delivery_fee = $vendor->min_delivery;
                 $cartTotal = $totalPrice + $cartTotal;
                //  $totalPrice = number_format($totalPrice, 2);
                 OrderItem::create([
                     'order_id' => $order_id,
                     'food_id' => $food_id,
                     'unit_price' => $item->unit_price,
                     'quantity' => $quantity,
                     'total' => $totalPrice,
                     
                 ]);
     
                 array_push($result['product'], [
                     'name' => $item->name,
                     'unit_price' => $item->unit_price,
                     'quantity' => $quantity,
                     'total' => $totalPrice,
                    
                 ]);
                 
             }
     
             $rawTotal = $cartTotal;

             $customer = customer();
             //Save order
             Order::create([
                'user_id' => $customer->customer_id,
                'vendor_id' => $vendor_id,
                'order_id' => $order_id,
                'rider_id' => '',
                'address_id' => $address,
                'delivery_fee' => $delivery_fee,
                'total' => $cartTotal,
                'grand_total' => $cartTotal + $delivery_fee,
                'status' => 'paid',
            ]);
             //Add the payment details to the payment table
             Payment::create([
                 'tx_ref' => $tx_ref,
                 'user_id' => $customer->customer_id,
                 'order_id' => $order_id,
                 'amount' => $amount,
                 'status' => $status,
             ]);
        //             Notify the customer
             Notification::create([
                 'customer_id' => $customer->customer_id,
                 'message' =>   'Your payment for order from ' . $vendor->biz_name . ' has been received successfully. Your order will be delivered soon',
                 'status' => true,
             ]);
             $result['delivery_fee'] = $delivery_fee;
             $result['total'] = $cartTotal;
             $result['grand_total'] = $cartTotal + $delivery_fee;
             $data = [
                'to' => $customer->email,
                'subject' => 'Order confirmation from Gfood',
                'view' => 'purchase',
                'name' => $customer->firstname . ' ' . $customer->surname,
                'body' => $result
            ];

    //            self::sendMail($data);
            Cart::clear();
             return ['status' => 'success', 'data' => $result];

        }catch(\Exception $e){
            return ['status' => 'error', 'message' => $e->getMessage()];
        }

    }

    public function confirmOrder($result){
        dd($result);
        return view('user.confirmation', [ 'result' => $result]);
    }

    public function sendMail($data){
        (New Mail())->send($data);
    }

    public function logout(){
        if(isAuthenticated()){
            Session::remove('SESSION_USER_ID');
            Session::remove('SESSION_USERNAME');

            if(!Session::has('user_cart')){
                session_destroy();
                session_regenerate_id(true);
            }
            
        }
        Redirect::to('/');
    }


    public function notifications(){
        return view('customer.notification', []);
    }


}