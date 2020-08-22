<?php


namespace App\Classes;


class Cart{
    protected static $isItemInCart = false;

    public static function add($request){
//        unset($_SESSION['user_cart']);
//        dd($_SESSION['user_cart']);
        try{
            $index = 0;
//            dd(Session::get('user_cart'));
            // Check if cart is empty
            if(!Session::has('user_cart') || count(Session::get('user_cart')) < 1){
                Session::add('user_cart', [
                    0 => ['food_id' => $request->food_id, 'quantity' => 1]
                ]);
            }else{
                foreach ($_SESSION['user_cart'] as  $cartItems){
                    $index++;
                    foreach($cartItems as $key => $value){
//                        If Item already exist, remove and update
                        if($key === 'food_id' and $value === $request->food_id){
                            array_splice($_SESSION['user_cart'], $index -1, 1, array(
                                [
                                    'food_id' => $request->food_id,
                                    'quantity' => $cartItems['quantity'] + 1
                                ]
                            ));
                            self::$isItemInCart = true;
                        }
                    }
                }
                if(!self::$isItemInCart){
                    array_push($_SESSION['user_cart'], [
                        'food_id' => $request->food_id, 'quantity' => 1
                    ]);
                }

            }
//            dd(Session::get('user_cart'));

        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    public static function  removeItem($index){
        if(count(Session::get('user_cart')) <= 1){
             // Empty cart
            unset($_SESSION['user_cart']);
        }else{
            // Empty particular item
            unset($_SESSION['user_cart'][$index]);
            sort($_SESSION['user_cart']);
        }
    }

    public static function clear(){
        Session::remove('user_cart');
    }

}