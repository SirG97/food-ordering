<?php


namespace App\Controllers;

use App\Classes\CSRFToken;
use App\Classes\Cart;
use App\Classes\Request;



class CartController extends BaseController{

    public function addItem(){

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