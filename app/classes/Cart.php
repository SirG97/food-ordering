<?php


namespace App\Classes;


class Cart{
    protected static $isItemInCart = false;

    public static function add($request){

        try{
            $index = 0;

            if(!Session::has('user_cart') || count(Session::get('user_cart')) < 1){
                Session::add('user_cart', [
                    0 => ['food_id' => $request->food_id, 'quantity' => 1]
                ]);
            }else{
                foreach ($_SESSION['user_cart'] as  $cartItems){
                    $index++;
                    foreach($cartItems as $key => $value){
                    //  If Item already exist, remove and update
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

class Hey{
    protected static $isItemInCart = false;

    public function add(Request $request){


////        Cart::add();
//        $cartItem = Cart::add($request->food_id, $request->name, $request->unit_price, 1);
        try{
            $index = 0;
            if(!session()->has('cart') || count(session()->get('cart')) < 1){
                session()->put('cart', [
                    0 => ['food_id' => $request->food_id, 'quantity' => 1]
                ]);
            }else{
                foreach (session()->get('cart') as  $cartItems){
                    $index++;
                    foreach($cartItems as $key => $value){
                        //  If Item already exist, remove and update
                        if($key === 'food_id' and $value === $request->food_id){
                            array_splice(session()->get('cart'), $index -1, 1, array(
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
                    array_push(session()->get('cart'), [
                        'food_id' => $request->food_id, 'quantity' => 1
                    ]);
                }

            }


        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    public function remove(Request $request){
        if(count(session()->get('cart')) <= 1){
            // Empty cart
            unset($_SESSION['cart']);
        }else{
            // Empty particular item
            unset($_SESSION['cart'][$request->index]);
            sort($_SESSION['cart']);
        }
    }

    public function addItem(Request $request){
//        dd(session()->forget('cart'), session()->save());
//        if(session()->has('food_id')){
//            foreach (session('food_id') as $food){
//
//            }
//            $cartItem = Cart::add($request->food_id, $request->name, $request->unit_price, 1);
//            session()->push('food_id', $cartItem);
//        }
//
//        dd(session('cart'));
//        dd(Cart::get());
//        session()->flush();
//        dd(session('cart'));
        if(!$request->food_id){
            return response()->json(['error' => 'Malicious Activity']);
        }

//        $this->add($request);
        $index = 0;
        if(!session('cart') || count(session('cart')) < 1){
            session()->put('cart', [
                ['food_id' => $request->food_id, 'quantity' => 1]
            ]);
        }else{
            foreach (session('cart') as  $cartItems){
//                $index++;
                foreach($cartItems as $key => $value){
                    //  If Item already exist, remove and update
                    if($key === 'food_id' and $value === $request->food_id){
                        session(["cart.{$index}.quantity" => $cartItems['quantity'] + 1]);
//                        array_splice(session()->get('cart'), $index -1, 1, array(
//                            [
//                                'food_id' => $request->food_id,
//                                'quantity' => $cartItems['quantity'] + 1
//                            ]
//                        ));
                        self::$isItemInCart = true;
                    }

                }
                $index++;
            }
            if(!self::$isItemInCart){
                session()->push('cart', [
                    'food_id' => $request->food_id, 'quantity' => 1
                ]);
//                array_push(session()->get('cart'), [
//                    'food_id' => $request->food_id, 'quantity' => 1
//                ]);
            }

        }
        $cartItem = Cart::add($request->food_id, $request->name, $request->unit_price, 1);

        return response()->json(['success' => 'Food added successfully']);

    }

    public function getCartItems(Request $request){
        dd(session('cart'));
            $result = array();
            $cartTotal = 0;
            if(!session()->has('cart') || count(session()->get('cart')) < 1){
                return response()->json(['error' => 'Cart is empty', 'authenticated' => Auth::check()]);

            }

            $index = 0;
            $vendor_id = '';

            foreach(session('cart') as $cartItem){
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

            return response()->json(['items' => $result,
                'grandTotal' => $grandTotal,
                'rawTotal' => $rawTotal,
                'cartTotal' => $cartTotal,
                'delivery_fee' => $delivery_fee,
                'authenticated' => Auth::check()]);

//        }catch (\Exception $e){
//            return response()->json(['error' => 'operation failed','authenticated' => Auth::check(), 'message' => $e]);
//        }
    }

    public function updateQuantity(Request $request){
        session()->flush();
            if(!$request->food_id){
                return response()->json(['error' => 'Malicious Activity']);
            }
            $index = 0;
            $quantity = '';
            foreach(session('cart') as $cart_item){
//                $index++;
                foreach($cart_item as $key => $value){
                    if($key == 'food_id' and $value == $request->food_id){
//                        dd(session("cart.{$index}"));
                        switch ($request->operator){
                            case '+':
                                $quantity = $cart_item['quantity'] + 1;
                                session(["cart.{$index}.quantity" => $quantity]);
                                break;
                            case '-':
                                $quantity = $cart_item['quantity'] - 1;
                                if($quantity < 1){
                                    $quantity = 1;
                                }
                                session(["cart.{$index}.quantity" => $quantity]);
                                break;
                        }
//                        dd(session("cart.{$index}"));
//                        $i = $index - 1;
//                        session()->push("cart.{$i}",  [
//                            'food_id' => $request->food_id,
//                            'quantity' => $quantity
//                        ]);
//                        session()->flush();
//                        dd($cart_item);
//                        dd(session()->get('cart'));
//
//                        dd(session('cart'));
//                        array_splice(session('cart'), $index -1, 1, array(
//                            [
//                                'food_id' => $request->food_id,
//                                'quantity' => $quantity
//                            ]
//                        ));

                    }

                }
                $index++;
            }

    }

    public function removeItem(Request $request){
//        dd((int)$request->item_index);
        if($request->item_index === ''){
            return response()->json(['error' => 'Malicious Activity']);
        }
        $value = session()->pull("cart.0");
//        $this->remove($request);

        if(count(session('cart')) <= 1){
            // Empty cart
            session()->forget('cart');;
        }else{
//            dd($request->item_index, session('cart'));
             session()->pull("cart.{$request->item_index}");
//            $cart = session('cart'); // Second argument is a default value
//
//            $key = array_search(2, $cart);
//            dd($cart, $key, $request->item_index);
//            if(($key = array_search($request->item_index, $cart)) !== false) {
//                dd($cart[$key]);
//            }
//            session()->put('cart', $cart);
            // Empty particular item
//            session()->pull("cart", $request->item_index);
//            dd(session('cart'));
            sort(session('cart'));
        }
        return response()->json(['success' => "Item removed from cart successfully"]);
    }
}