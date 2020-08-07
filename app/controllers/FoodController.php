<?php

namespace App\Controllers;


use App\Classes\Resize;
use App\Classes\Upload;
use App\Models\Vendor;
use App\Models\Food;
use App\Models\User;
use App\Models\Rider;
use App\Models\FoodCategory;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Classes\CSRFToken;
use App\Classes\Random;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Session;
use App\Classes\Validation;




class FoodController extends BaseController {
    public function __construct(){
        if(!isAuthenticated()){
            Redirect::to('/login');
        }
    }

    public function index(){

    }

    public function store(){
        if(Request::has('post')){
            $request = Request::get('post');

            if(CSRFToken::verifyCSRFToken($request->token)){

                $rules = [
                    'vendor_id' => ['required' => true,'mixed' => true],
                    'food_category' => ['required' => true,'minLength' => 2, 'maxLength' => 30],
                    'name' => ['required' => true,'mixed' => true, 'minLength' => 2, 'maxLength' => 30],
                    'unit_price' => ['required' => true,'number' => true, ],
                    'description' => ['mixed' => true, 'minLength' => 2, 'maxLength' => 100],
                ];

                $validation = new Validation();
                $validation->validate($_POST, $rules);
                //Handle file upload
                $file = Request::get('file');

                $filename = isset($file->food_img->name) ? $filename = $file->food_img->name: $filename = '';
                $file_error = [];
                if(isset($file->food_img->name) && !Upload::is_image($filename)){
                    $file_error['food_img'] = ['Image is not a valid image'];
                }
                if($validation->hasError()){
                    $input_errors = $validation->getErrorMessages();
                    count($file_error) ? $errors = array_merge($input_errors, $file_error) : $errors = $input_errors;
                    $vendor = Vendor::where('vendor_id', $request->vendor_id)->with('foodCategories.food')->first();
                    return view('user.vendor', ['vendor' => $vendor, 'errors' => $errors]);

                }

                // Deal with the upload first
                $ds = DIRECTORY_SEPARATOR;
                // Resize the image
                $temp_file = $file->food_img->tmp_name;

                $image_path = Upload::move($temp_file, "img{$ds}uploads{$ds}foods", $filename)->path();
                if($image_path !== ''){
                    $resize = new Resize();
                    $resize->squareImage($image_path, $image_path, 280);
                }


                //Add the user
                $details = [
                    'vendor_id' => $request->vendor_id,
                    'food_id' => Random::generateId(16),
                    'category_id' => $request->food_category,
                    'name' => $request->name,
                    'unit_price' => $request->unit_price,
                    'description' => $request->description,
                    'image' => $image_path
                ];
                Food::create($details);
                Request::refresh();
                Session::add('success', 'Food added successfully');
                $vendor = Vendor::where('vendor_id', $request->vendor_id)->with('foodCategories.food')->first();
                return view('user.vendor', ['vendor' => $vendor]);

            }else{
                echo 'token error';
            }

            //Redirect::to('/customer');
        }else{
            echo 'request error';
        }
    }

    public function update($id){
        $food_id = $id['food_id'];
//            dd(Request::all());
        if(Request::has('post')){
            $request = Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token, false)){
                $rules = [
                    'food_id' => ['required' => true,'mixed' => true],
                    'food_category' => ['required' => true,'minLength' => 2, 'maxLength' => 30],
                    'name' => ['required' => true,'mixed' => true, 'minLength' => 2, 'maxLength' => 30],
                    'unit_price' => ['required' => true,'number' => true, ],
                    'description' => ['mixed' => true, 'minLength' => 2, 'maxLength' => 100],
                ];

                $validation = new Validation();
                $validation->validate($_POST, $rules);
                //Handle file upload
                $file = Request::get('file');
                $filename = isset($file->food_img->name) ? $filename = $file->food_img->name: $filename = '';
                $file_error = [];
                if(isset($file->food_img->name) && !Upload::is_image($filename)){
                    $file_error['food_img'] = ['Image is not a valid image'];
                }
                if($validation->hasError()){
                    $errors = $validation->getErrorMessages();

                    header('HTTP 1.1 422 Unprocessable Entity', true, 422);
                    echo json_encode($errors);
                    exit();
                }

                $food = Food::where('food_id', $food_id)->first();

                //Add the order details to an array
                //Add the user
                $food->category_id = $request->food_category;
                $food->name = $request->name;
                $food->unit_price = $request->unit_price;
                $food->description = $request->description;


                // Deal with the upload first
                if($filename){
                    $ds = DIRECTORY_SEPARATOR;
                    //get the old image for deletion
                    $old_image = BASE_PATH ."{$ds}public{$ds}$food->image";
                    $temp_file = $file->food_img->tmp_name;
                    // Upload image
                    $image_path = Upload::move($temp_file, "img{$ds}uploads{$ds}foods", $filename)->path();
                    // Resize image
                    if($image_path !== ''){
                        $resize = new Resize();
                        $resize->squareImage($image_path, $image_path, 128);
                    }
                    unlink($old_image);
                    $food->image = $image_path;
                }

                try{
                    $food->save();
                    echo json_encode(['success' => 'Food updated successfully']);
                    exit();
                }catch (\Exception $e){
                    header('HTTP 1.1 500 Server Error', true, 500);
                    echo json_encode(['error' => 'Food updated failed', 'e' => $e->getMessage()]);
                    exit();
                }
            }else{
                header('HTTP 1.1 400 Token Error', true, 400);
                echo json_encode(['error' => 'Token error Food updated failed']);
                exit();
            }

            //Redirect::to('/customer');
        }else{
            echo 'request error';
        }
    }

    public function delete($id){
        $food_id = $id['food_id'];
        if(Request::has('post')){
            $request = Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token)){
                try{
                    $food = Food::where('food_id', '=', $food_id)->first();
                    $food->delete();
                    Session::add('success', 'Food deleted successfully');

                    Redirect::back();
                }catch (\Exception $e){
                    Session::add('error', 'Food deletion failed');
                    Redirect::back();
                }

            }
        }else{
            Session::add('error', 'Food deletion failed');
            Redirect::back();
        }
    }
}