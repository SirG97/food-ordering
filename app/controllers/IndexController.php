<?php

namespace App\Controllers;
use App\Classes\CSRFToken;
use App\Classes\Mail;
use App\Classes\Redirect;
use App\Models\Vendor;

class IndexController extends BaseController{
    public function index(){

        return view('user.index');
    }

    public function restaurants(){
        $vendors = Vendor::all();
        return view('user.restaurants', ['vendors' => $vendors]);

    }

    public function restaurant($id){
        $vendor_id = $id['uid'];
        $token = CSRFToken::_token();
        $vendor = Vendor::where('vendor_id', $vendor_id)->first();
        return view('user.restaurant', ['vendor' => $vendor, 'token' => $token]);
    }

    public function getMenu($id){
        $vendor_id = $id['uid'];
//        $vendor = Vendor::where('vendor_id', $vendor_id)->first();
        $vendor = Vendor::where('vendor_id', $id)->with('foodCategories.food')->first();
        echo json_encode(['status' => 'success', 'vendor' => $vendor]);
        exit();
    }

    public function revieworder(){
        return view('user.revieworder');
    }
}