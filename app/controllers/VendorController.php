<?php


namespace App\controllers;

use App\Classes\Resize;
use App\Classes\Upload;
use App\Models\FoodCategory;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Classes\CSRFToken;
use App\Classes\Random;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Session;
use App\Classes\Validation;
use App\Models\Vendor;
use App\Models\Food;

class VendorController extends BaseController{
    public function create(){
        return view('user.registervendor');
    }

    public function store(){
        if(Request::has('post')){
            $request = Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token)){
                $rules = [
                    'firstname'  => ['required' => true,'string' => true, 'minLength' => 2, 'maxLength' => 100,],
                    'lastname' => ['required' => true,'string' => true, 'minLength' => 2, 'maxLength' => 100,],
                    'email' => ['required' => true,'email' => true],
                    'phone' => ['required' => true,'number' => true],
                    'address' => ['mixed' => true],
                    'biz_name'=> ['required' => true,'mixed' => true],
                    'subtitle' => ['mixed' => true, 'minLength' => 2, 'maxLength' => 100,],
                    'description' => ['mixed' => true, 'minLength' => 2, 'maxLength' => 200,],
                    'city' => ['string' => true, 'maxLength' => 20,],
                    'state' => ['string' => true,],
                    'biz_address' => ['mixed' => true, 'required' => true, 'maxLength' => 50],

                    'mobile' => ['number' => true, 'required' => true, 'maxLength' => 15],
                    'alt_mobile' => ['number' => true, 'maxLength' => 15],
                    'opening_time' => ['required' => true, ],
                    'closing_time' => ['required' => true,],
//                    'sat_opening'=> [ 'mixed' => true],
//                    'sat_close'=> [ 'mixed' => true],
//                    'sun_opening'=> [ 'mixed' => true],
//                    'sun_close'=> [ 'mixed' => true]
                ];
                $validation = new Validation();
                $validation->validate($_POST, $rules);
                if($validation->hasError()){
                    $errors = $validation->getErrorMessages();
                    dd($errors);
                    return view('user.registervendor', ['errors' => $errors]);
                }

//                $tags = explode(',', $request->tags);
                $tags = implode(',', $request->tags);

                //Add the user
                $details = [
                            'vendor_id' => Random::generateId(16),
                            'firstname'  => $request->firstname,
                            'lastname'  => $request->lastname,
                            'email'  => $request->email,
                            'phone'  => $request->phone,
                            'address'  => $request->address,
                            'biz_name'  => $request->biz_name,
                            'subtitle'  => $request->subtitle,
                            'description'  => $request->description,
                            'city'  => $request->city,
                            'state'  => $request->state,
                            'biz_address'  => $request->biz_address,
                            'tags'  => $tags,
                            'mobile'  => $request->mobile,
                            'alt_mobile'  => $request->alt_mobile,
                            'opening_time'  => $request->opening_time,
                            'closing_time'  => $request->closing_time,
                            'sat_opening'  => $request->sat_opening,
                            'sat_closing'  => $request->sat_closing,
                            'sun_opening'  => $request->sun_opening,
                            'sun_closing'  => $request->sun_closing,
                            'min_order'  => $request->min_order,
                            'min_delivery'  => $request->min_delivery,
                            'container_fee'  => $request->container_fee
                    ];

                Vendor::create($details);
                Request::refresh();
                Session::add('success', 'Vendor registration successfully');
                Redirect::to('/vendor/register');
                exit();
            }

            Session::add('error', 'Vendor registration failed, please try again');
            Redirect::to('/vendor/register');
            exit();
        }
    }

    public function index(){
        $vendors = Vendor::all();
        return view('user.vendors', ['vendors' => $vendors]);
    }

    public function show($id){
        $id = $id['uid'];
        $vendor = Vendor::where('vendor_id', $id)->with('foodCategories.food')->first();
        return view('user.vendor', ['vendor' => $vendor]);
    }

    public function edit($id){
        $uid = $id['uid'];
        $vendor = Vendor::where('vendor_id', $uid)->first();

        return view('user.editvendor', ['vendor' => $vendor]);
    }

    public function update($id){
        $vendor_id = $id['uid'];

        if(Request::has('post')){
            $request = Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token)){
                $rules = [
                    'firstname'  => ['required' => true,'string' => true, 'minLength' => 2, 'maxLength' => 100,],
                    'lastname' => ['required' => true,'string' => true, 'minLength' => 2, 'maxLength' => 100,],
                    'email' => ['required' => true,'email' => true, 'unique_edit' => 'vendors|' . $vendor_id .'|vendor_id'],
                    'phone' => ['required' => true,'number' => true, 'unique_edit' => 'vendors|' . $vendor_id .'|vendor_id'],
                    'address' => ['mixed' => true],
                    'biz_name'=> ['required' => true,'mixed' => true],
                    'subtitle' => ['mixed' => true, 'minLength' => 2, 'maxLength' => 100,],
                    'description' => ['mixed' => true, 'minLength' => 2, 'maxLength' => 200,],
                    'city' => ['string' => true, 'maxLength' => 20,],
                    'state' => ['string' => true,],
                    'biz_address' => ['mixed' => true, 'required' => true, 'maxLength' => 50],

                    'mobile' => ['number' => true, 'required' => true, 'maxLength' => 15],
                    'alt_mobile' => ['number' => true, 'maxLength' => 15],
                    'opening_time' => ['required' => true, ],
                    'closing_time' => ['required' => true,],
//                    'sat_opening'=> [ 'mixed' => true],
//                    'sat_close'=> [ 'mixed' => true],
//                    'sun_opening'=> [ 'mixed' => true],
//                    'sun_close'=> [ 'mixed' => true]
                ];
                $validation = new Validation();
                $validation->validate($_POST, $rules);
                if($validation->hasError()){
                    $errors = $validation->getErrorMessages();

                    return view('user.editvendor', ['errors' => $errors]);
                }

                $tags = implode(',', $request->tags);

                $vendor = Vendor::findOrFail($vendor_id);

                //Add the user

                $vendor->firstname  = $request->firstname;
                $vendor->lastname  = $request->lastname;
                $vendor->email = $request->email;
                $vendor->phone = $request->phone;
                $vendor->address = $request->address;
                $vendor->biz_name = $request->biz_name;
                $vendor->subtitle = $request->subtitle;
                $vendor->description = $request->description;
                $vendor->city = $request->city;
                $vendor->state = $request->state;
                $vendor->biz_address = $request->biz_address;
                $vendor->tags = $tags;
                $vendor->mobile = $request->mobile;
                $vendor->alt_mobile = $request->alt_mobile;
                $vendor->opening_time = $request->opening_time;
                $vendor->closing_time = $request->closing_time;
                $vendor->sat_opening = $request->sat_opening;
                $vendor->sat_closing = $request->sat_closing;
                $vendor->sun_opening = $request->sun_opening;
                $vendor->sun_closing = $request->sun_closing;
                $vendor->min_order = $request->min_order;
                $vendor->min_delivery = $request->min_delivery;
                $vendor->container_fee = $request->container_fee;


                $vendor->save();
                Request::refresh();
                Session::add('success', 'Vendor details updated successfully');
                Redirect::back();
                exit();
            }

            Session::add('error', 'Vendor details update failed, please try again');
            Redirect::back();
            exit();
        }
    }

    public function storeFoodCategory(){

    }



    public function store_route(){
        if(Request::has('post')){
            $request = Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token)){
                $rules = [
                    'name' => ['required' => true, 'minLength' => 2, 'maxLength' => 100],
                    'district' => ['required' => true],
                ];
                $validation = new Validation();
                $validation->validate($_POST, $rules);
                if($validation->hasError()){
                    $errors = $validation->getErrorMessages();
                    return view('user\district', ['errors' => $errors]);
                }

                $district = Capsule::table('districts')->where('district_id',$request->district)->first();

                $district = $district->name;

                //Add the user
                $details = [
                    'district_id' => $request->district,
                    'district' => $district,
                    'route_id' => Random::generateId(16),
                    'name' => $request->name,
                    'created_by' => Session::get('SESSION_USERNAME'),
                ];
                Food::create($details);
                Request::refresh();
                Session::add('success', 'New route created successfully');
                Redirect::to('/district_routes');
                exit();
            }

            Session::add('error', 'Food creation failed, try again');
            Redirect::to('/district_routes');
            exit();
        }
    }

    public function edit_route($id){
        $route_id = $id['route_id'];
        if(Request::has('post')){
            $request = Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token, false)){
                $rules = [
                    'district' => ['required' => true],
                    'district_id' => ['required' => true],
                    'name' => ['required' => true],
                ];
                $validation = new Validation();
                $validation->validate($_POST, $rules);
                if($validation->hasError()){
                    $errors = $validation->getErrorMessages();
                    header('HTTP 1.1 422 Unprocessable Entity', true, 422);
                    echo json_encode($errors);
                    exit();
                }

                //Add the user
                $details = [
                    'district_id' => $request->district_id,
                    'district' => $request->district,
                    'name' => $request->name,
                ];
                try{
                    Food::where('route_id', $route_id)->update($details);
                    echo json_encode(['success' => 'Food updated successfully']);
                    exit();
                }catch (\Exception $e){
                    header('HTTP 1.1 500 Server Error', true, 500);
                    echo json_encode(['error' => 'Food updated failed ' . $e]);
                    exit();
                }

            }else{
                echo 'token error';
            }
            //Redirect::to('/customer');
        }else{
            echo 'request error';
        }
    }

    public function delete_route($id){
        $route_id = $id['route_id'];

        if(Request::has('post')){
            $request = Request::get('post');

            if(CSRFToken::verifyCSRFToken($request->token)){

                $route = Food::where('route_id', '=', $route_id)->first();
                $route->delete();
                Session::add('success', 'Food deleted successfully');
                Redirect::to('/district_routes');
            }
//            Session::add('error', 'Customer deletion failed');
//            Redirect::to('/customers');
        }else{
            echo 'request error';
        }
    }

    public function edit_district(){

    }

    public function delete_district(){

    }
}