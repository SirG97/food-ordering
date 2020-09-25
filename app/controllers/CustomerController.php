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
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Food;
use App\Models\Vendor;
use App\Models\Payment;

class CustomerController extends BaseController{
    public function getLogin(){
        // Session::add('referer', $_SERVER['HTTP_REFERER'] || false);
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
    
                        if(Session::has('referer')){
                            $url = Session::get('referer');
                            Session::remove('referer');
                            Redirect::to($url);
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
        return view('customer.profile', ['success' => '','errors' => []]);

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
        
        $orders = Order::where('user_id', Session::get('SESSION_USER_ID'))->with('vendor')->get();
        
        return view('customer.orders', ['orders' => $orders]);
    }

    public function showOrder($id){
        $order_id =  $id['order_id'];
        $order = Order::where('order_id', $order_id)->with(['orderItem.food', 'vendor'])->first();
       
        return view('customer.order', ['order' => $order]);
    }

    public function showProfile(){
        $orders = Order::where('user_id', Session::get('user_id'))->get();
        return view('customer.profile', ['orders' => $orders]);
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
                        
                   $saveOrder =  self::storePaymentAndOrder($tx_ref, $amount, $status);

                   if($saveOrder['status'] == 'success'){
                        // return view('user.confirmation', ['result' => $saveOrder]);
                        // // echo json_encode([ 'result' => $saveOrder['data']]);
                        // // exit;
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

    public function storePaymentAndOrder($tx_ref, $amount, $status){
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
                 $delivery_fee = Vendor::where('vendor_id', $vendor_id)->first()->min_delivery;
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
             //Save order
             Order::create([
                'user_id' => customer()->user_id,
                'vendor_id' => $vendor_id,
                'order_id' => $order_id,
                'rider_id' => '',
                'delivery_fee' => $delivery_fee,
                'total' => $cartTotal,
                'grand_total' => $cartTotal + $delivery_fee,
                'status' => 'paid',
            ]);
             //Add the payment details to the payment table
             Payment::create([
                 'tx_ref' => $tx_ref,
                 'user_id' => customer()->user_id,
                 'order_id' => $order_id,
                 'amount' => $amount,
                 'status' => $status,
             ]);
             $result['delivery_fee'] = $delivery_fee;
             $result['total'] = $cartTotal;
             $result['grand_total'] = $cartTotal + $delivery_fee;
             $data = [
                'to' => customer()->email,
                'subject' => 'Order confirmation from Gfood',
                'view' => 'purchase',
                'name' => customer()->firstname . ' ' . customer()->surname,
                'body' => $result
            ];

            self::sendMail($data);
            Cart::clear();
             return ['status' => 'success', 'data' => $result];

        }catch(\Exception $e){
            return ['status' => 'error', 'message' => $e->getMessage()];
        }

    }

    public function confirmOrder($result){
        
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