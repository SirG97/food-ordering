<?php


namespace App\Controllers;



use App\Models\FoodCategory;
use App\Models\Food;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Classes\CSRFToken;
use App\Classes\Random;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Session;
use App\Classes\Validation;
use App\Models\Order;
use Carbon\Carbon;


class CartController extends BaseController{

    public function addItem($id){

        if(Request::has('post')){
            $request = Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token, false)){
                if(!$request->food_id){
                    throw new \Exception('Malicious Activity');
                }

                Cart::add($request);
                echo json_encode(['success' => 'Food added successfully']);
                exit();
            }

        }else{
            echo 'request error';
        }
    }


}