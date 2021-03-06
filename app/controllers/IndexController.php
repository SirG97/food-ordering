<?php

namespace App\Controllers;
use App\Classes\CSRFToken;
use App\Classes\Mail;
use App\Classes\Redirect;
use App\Classes\Session;
use App\Models\Vendor;
use App\Models\Review;
use App\Models\Customer;

class IndexController extends BaseController{
    public function index(){
        $vendors = Vendor::all();
        return view('user.index', ['vendors' => $vendors]);
    }

    public function restaurants(){
        $vendors = Vendor::all();
//        $v = Vendor::with('orders')->withCount('orders')->get();
//        dd($v);
        return view('user.restaurants', ['vendors' => $vendors]);

    }

    public function restaurant($id){
        $vendor_id = $id['uid'];
        $token = CSRFToken::_token();
        $vendor = Vendor::where('vendor_id', $vendor_id)->first();
        $reviews = Review::where('vendor_id', $vendor_id)->with('customer')->get();
        $r = Review::where('vendor_id', $vendor_id)->sum('rating');
        $rating = round(($r / count($reviews)),1 );
//        dd($reviews[0]->customer['firstname']);
        return view('user.restaurant', ['vendor' => $vendor, 'reviews'=> $reviews,'rating' => $rating, 'token' => $token]);
    }

    public function getMenu($id){
        $vendor_id = $id['uid'];
//        $vendor = Vendor::where('vendor_id', $vendor_id)->first();
        $vendor = Vendor::where('vendor_id', $id)->with('foodCategories.food')->first();
        echo json_encode(['status' => 'success', 'vendor' => $vendor]);
        exit();
    }

    public function revieworder($id){
        $token = CSRFToken::_token();
        $vendor_id = $id['uid'];
        $vendor = Vendor::where('vendor_id', $id)->first();
        $customer = Customer::where('customer_id', Session::get('SESSION_USER_ID'))->with('addresses')->first();
//        dd($customer->addresses[0]);
        return view('user.revieworder', ['token' => $token, 'vendor' => $vendor, 'customer' => $customer]);
    }


    public function home(){
        return view('user.home');
    }
}