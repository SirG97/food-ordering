<?php


namespace App\Controllers;

use App\Classes\CSRFToken;
use App\Classes\Cart;
use App\Classes\Request;
use App\Classes\Session;
use App\Models\Food;
use App\Models\Vendor;


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
            $rawTotal = $cartTotal;
            $cartTotal = number_format($cartTotal, 2);
            $delivery_fee = Vendor::where('vendor_id', $vendor_id)->first()->min_delivery;
            $grandTotal = number_format(((int)$rawTotal + (int)$delivery_fee), 2);
            $rawTotal = (int)$rawTotal + (int)$delivery_fee;

            echo json_encode(['items' => $result,
                              'grandTotal' => $grandTotal, 
                              'rawTotal' => $rawTotal,
                              'cartTotal' => $cartTotal, 
                              'delivery_fee' => $delivery_fee,
                              'authenticated' => isAuthenticated()]);
            exit();
        }catch (\Exception $e){
            echo json_encode(['error' => 'operation failed', 'message' => $e]);
        }
    }

    public function updateQuantity(){
        if(Request::has('post')){
            $request = Request::get('post');
            if(!$request->food_id){
                throw new \Exception('Malicious Activity');
            }

            $index = 0;
            $quantity = '';
            foreach($_SESSION['user_cart'] as $cart_item){
                $index++;
                foreach($cart_item as $key => $value){
                    if($key == 'food_id' and $value == $request->food_id){
                        switch ($request->operator){
                            case '+':
                                $quantity = $cart_item['quantity'] + 1;
                                break;
                            case '-':
                                $quantity = $cart_item['quantity'] - 1;
                                if($quantity < 1){
                                    $quantity = 1;
                                }
                                break;
                        }

                        array_splice($_SESSION['user_cart'], $index -1, 1, array(
                            [
                                'food_id' => $request->food_id,
                                'quantity' => $quantity
                            ]
                        ));
                    }
                }
            }

        }else{
            echo 'request error';
        }
    }

    public function removeItem(){
        if(Request::has('post')){
            $request = Request::get('post');
            if($request->item_index === ''){
                throw new \Exception('Malicious Activity');
            }
            Cart::removeItem($request->item_index);
            echo json_encode(['success' => "Item removed from cart successfully"]);
            exit;
        }else{
            echo 'request error';
        }
    }

}