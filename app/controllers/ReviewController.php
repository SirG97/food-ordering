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
use App\Models\Review;

class ReviewController extends BaseController{
    public function showReviews(){
        $reviews = Review::where('customer_id', Session::get('SESSION_USER_ID'))->with('vendor')->get();
    
        return view('customer.review', ['reviews' => $reviews]);
    }

    public function saveReview(){
        
        if(Request::has('post')){
            $request = Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token, false)){
                $rules = [
                    'rating' => ['required' => true, 'number' => true],
                    'feedback' => ['mixed' => true],
                    'vendor' => ['mixed' => true, 'required' => true],
                   
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
                    'customer_id' => customer()->customer_id,
                    'vendor_id' => $request->vendor_id,
                    'review_id' => Random::generateId(16),
                    'rating' => $request->rating,
                    'feedback' => $request->feedback,
                ];
                
                try{
                    Review::create($details);
                    
                    echo json_encode(['success' => 'Review saved successfully']);
                    exit();
                }catch (\Exception $e){
                    header('HTTP 1.1 500 Server Error', true, 500);
                    echo json_encode(['error' => 'Could not save review. please try again' . $e->getMessage()]);
                    exit();
                }
            }
           
        }
    }
    
}