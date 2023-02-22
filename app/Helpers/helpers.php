<?php

use Illuminate\Support\Facades\Route;

if (! function_exists('moneyFormat')) {
    function moneyFormat($str) {
        return number_format($str, '0', '', '.');
    }
}

if (! function_exists('discount')) {
    function discount($price, $discount){
        return $price - ($price * $discount / 100);
    }
}

if (! function_exists('active')) {
    function active($params){
        return Route::is($params) ? 'active' : '' ;
    }
}

if(! function_exists('activeNav')){
    function activeNav($params){
        return Route::is($params) ? 'text-blue-500' : '';
    }
}

if (! function_exists('videoActive')) {
    function videoActive($params){
        return request()->segment(3) == $params ? 'border rounded-lg bg-slate-800' : '' ;
    }
}