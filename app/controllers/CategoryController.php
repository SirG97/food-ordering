<?php


namespace App\Controllers;


use App\Classes\CSRFToken;
use App\Classes\Random;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Session;
use App\Classes\Validation;
use App\Models\FoodCategory;

class CategoryController{
    public function index(){

    }

    public function create(){

    }

    public function store(){
        if(Request::has('post')){
            $request = Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token)){
                $rules = [
                    'vendor_id' => ['required' => true,'mixed' => true],
                    'name' => ['required' => true,'string' => true, 'minLength' => 2, 'maxLength' => 100],
                ];
                $validation = new Validation();
                $validation->validate($_POST, $rules);
                if($validation->hasError()){
                    $errors = $validation->getErrorMessages();
                    return view('user.vendor', ['errors' => $errors]);
                }

                //Add the user
                $details = [
                    'category_id' => Random::generateId(16),
                    'category_name' => $request->name,
                    'vendor_id' => $request->vendor_id,
                ];
                FoodCategory::create($details);
                Request::refresh();
                Session::add('success', 'New food category created successfully');
                Redirect::back();
                exit();
            }

            Session::add('error', 'Food Category creation failed, try again');
            Redirect::back();
            exit();
        }
    }

    public function show($id){

    }

    public function edit($id){

    }

    public function update($id){

    }

    public function delete(){

    }
}