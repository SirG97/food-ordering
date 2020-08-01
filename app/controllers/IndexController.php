<?php

namespace App\Controllers;
use App\Classes\Mail;
use App\Classes\Redirect;

class IndexController extends BaseController{
    public function index(){
        return view('user\index');
    }

    public function restaurants(){
        return view('user\restaurants');
    }

    public function restaurant(){
        return view('user\restaurant');
    }

    public function revieworder(){
        return view('user\revieworder');
    }
}