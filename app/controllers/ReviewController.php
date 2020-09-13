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
    public function showReviews(){
        $orders = Order::where('user_id', Session::get('user_id'))->get();
        return view('customer.review', ['orders' => $orders]);
    }

    public function saveReview(){
        if(Request::has('post')){
            $request = Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token, false)){
                $rules = [
                    'rating' => ['required' => true, 'number' => true],
                    'feedback' => ['mixed' => true],
                   
                ];
                $validation = new Validation();
                $validation->validate($_POST, $rules);
                if($validation->hasError()){
                  
                    $errors = $validation->getErrorMessages();
                    header('HTTP 1.1 422 Unprocessable Entity', true, 422);
                    echo json_encode($errors);
                    exit();
                }

                // Calculate due date from from service type
               

                //Add the user
                $details = [
                    'order_no' => $order_no,
                    'request_type' => $request->request_type,
                    'service_type' => $request->service_type,
                    'email' => $request->email,
                   
                ];

                Order::create($details);
                Request::refresh();
                Session::add('success', 'New order created successfully');

                Redirect::to('/orders');
                exit();
            }

            Redirect::to('/orders');
        }
    }
    
}