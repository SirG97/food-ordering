<?php


namespace App\Classes;


class Menu{
    public static function is_active($menuItem){
        $uri = $_SERVER['REQUEST_URI'];
        if($uri === $menuItem){
            return 'selected';
        }
        return '';
    }

    public static function sidebar($menuItem){
        $uri = $_SERVER['REQUEST_URI'];
        if($uri === $menuItem){
            return 'active';
        }
        return '';
    }
}