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


    public function storeFood(){
        if(Request::has('post')){
            $request = Request::get('post');

            if(CSRFToken::verifyCSRFToken($request->token)){
                $rules = [
                    'vendor_id' => ['required' => true,'mixed' => true],
                    'food_category' => ['required' => true,'minLength' => 2, 'maxLength' => 30],
                    'name' => ['required' => true,'string' => true, 'minLength' => 2, 'maxLength' => 30],
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
                    return view('user.vendor', ['errors' => $errors]);
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
                    'food_category_id' => $request->food_category,
                    'name' => $request->name,
                    'unit_price' => $request->unit_price,
                    'description' => $request->description,
                    'image' => $image_path
                ];
                Food::create($details);
                Request::refresh();
                Session::add('success', 'Food added successfully');

                Redirect::back();
                exit();
            }else{
                echo 'token error';
            }

            //Redirect::to('/customer');
        }else{
            echo 'request error';
        }
    }
}