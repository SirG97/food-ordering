<?php


namespace App\Controllers;

use App\Classes\CSRFToken;
use App\Classes\Cart;
use App\Classes\Request;
use App\Classes\Session;
use App\Models\Food;


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

    public function getCartItems(){
        try{
            $result = array();
            $cartTotal = 0;
            if(!Session::has('user_cart') || count(Session::get('user_cart')) < 1){
                echo json_encode(['fail' => 'Cart is empty']);
                exit();
            }

            $index = 0;
            foreach($_SESSION['user_cart'] as $cartItem){
                $food_id = $cartItem['food_id'];
                $quantity = $cartItem['quantity'];
                $item = Food::where('food_id', $food_id)->first();
                if(!$item){ continue; }

                $totalPrice = $item->price * $quantity;
                $cartTotal = $totalPrice + $cartTotal;
                $totalPrice = number_format($totalPrice, 2);

                array_push($result, [
                    'food_id' => $item->food_id,
                    'name' => $item->name,
                    'image' => $item->image,
                    'unit_price' => $item->unit_price,
                    'quantity' => $quantity,
                    'total' => $totalPrice,
                    'index' => $index
                ]);
                $index++;
            }

            $cartTotal = number_format($cartTotal, 2);

            echo json_encode(['items' => $result, 'cartTotal' => $cartTotal]);
            exit();
        }catch (\Exception $e){
            echo json_encode(['error' => 'operation failed', 'message' => $e]);
        }
    }

}