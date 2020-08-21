<?php


namespace App\Classes;


class Cart{
    protected static $isItemInCart = false;

    public static function add($request){
        try{
            $index = 0;
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
        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }


}