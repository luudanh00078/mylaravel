<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
       $username = $request['username'];
       $password = $request['password'];
       if(Auth::attempt(['name'=>$username,'password'=>$password])) //auth tu dong ket noi so sanh du lieu voi data
       {
           return view('thanhcong',['user'=>Auth::user()]); //lay thong tin nguoi dang nhap
       }
       else
       {
        return view('dangnhap',['error'=>'Dang nhap that bai']);
        // return view('dangnhap')->with('customer', $customer);
       }

    }
    public function logout()
    {
        Auth::logout(); //logout
        return view('dangnhap');

    }
}
