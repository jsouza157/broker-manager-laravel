<?php
/**
 * Created by PhpStorm.
 * User: jefferson
 * Date: 24/12/18
 * Time: 11:37
 */
use App\Broker;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


if (! function_exists('cleanPhone')) {
    function cleanNumber($phone) {
        return preg_replace("/[^0-9]/", "", $phone);
    }
}

if (! function_exists('cleanReal')) {
    function cleanReal($value) {
        return str_replace(',','.',str_replace('.','',$value));
    }
}

if (! function_exists('deleteImageS3')) {
    function deleteImageS3($img)
    {
        Storage::disk("s3")->delete($img);
        return true;
    }
}

if (! function_exists('rootId')){
    function rootId(){
        if(Auth::guard('broker')->check()){
            return Auth::guard('broker')->user()->user_id;
        }
        if(Auth::guard('web')->check()){
            return Auth::guard('web')->user()->id;
        }
    }
}

if (! function_exists('userAdmin')){
    function userAdmin(){
        if(Auth::guard('web')->check()){
            return true;
        } else {
            $brokerAdmin = Broker::where('user_id', "=", Auth::guard('broker')->user()->user_id)
            ->where('admin', "=", 1)->get();
            if(count($brokerAdmin) != 0){
                return true;
            } else{
                return false;
            }
        }
    }
}

if (! function_exists('real')){
    function real($money){
        return number_format($money, 2, ',', '.');
    }
}

if (! function_exists('cep')) {
    function cep($cep) {
        return preg_replace("/^(\d{5})(\d{3})$/", "\\1-\\2", $cep);
    }
}

if(! function_exists('phone')) {
    function phone($number) {
        return preg_replace("/^(\d{2})(\d{4})(\d{5})$/", "\\1 \\2-\\3", $number);
    }
}
