<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response; //khai bao Response!

class MyController extends Controller
{
    public function XinChao()
    {
        echo "Chao cac ban minh la superhack";
    }
    public function KhoaHoc($ten)
    {
       echo "Khoa hoc :" .$ten;
       return redirect()->route('MyRoute2');
    }
    //lam viec voi URL
    public function GetURL(Request $request)
    {
        //return $request->url();
        // if($request->isMethod('post'))
        //    echo "Phuong thuc Post";
        // else
        //    echo "Khong phai phuong thuc post";
        if($request->is('My*'))
           echo "Co My";
        else
           echo "Khong co My";
    }
    //bai11:gui nhan du lieu voi request
    public function postForm(Request $request)
    {
        echo "Ten cua ban la:";
        // echo $request->input('HoTen');  
        echo $request->HoTen;

        //kiem tra tham so co ton tai
        // if($request->has('Tuoi'))
        //    echo "Co tham so";
        // else
        //    echo "Khong co tham so";

    }
    //bai12 Cookie
    public function setCookie()
    {
        $response = new Response();
        $response->withCookie('KhoaHoc','Laravel-LuuDanh',0.2); //ten-giatri-thoigian
        echo "Da set Cookie";
        return $response;
    }
    public function getCookie(Request $request)
    {
        echo "Cookie cua ban la:";
        return $request->cookie('KhoaHoc');
    }
    //bai13-14
    public function postFile(Request $request)
    {
        if($request->hasFile('myFile'))
        {
            $file = $request->file('myFile');
            if($file->getClientOriginalExtension('myFile') == "JPG") //kiem tra duoi file co phai laf jpg
            {
                $filename = $file->getClientOriginalName('myFile');//lay ten file
                //echo $filename;
                $file->move('img',$filename);
                echo "Da luu file :".$filename;
            }
            else
            {
                echo "Khong duoc phep upload file";
            }
         
        }
        else
        {
            echo "Chua co File";
        }
    }
    //bai15 Json
    public function getJson()
    {
        $array = ['Laravel','Php','ASP.net','HTML'];
        // $array = ['KhoaHoc'=>'Laravel-KhoaPham'];
        return response()->json($array);
    }
    //bai16 View
    public function getMyView()
    {
        return view('view.testView');
    }
    //bai17
    public function getView($t)
    { 
        return view('myView',['time'=>$t]);

    }
    //bai20 +21
    public function blade($str)
    {
        $khoahoc = "<b>LuuDanh-Laravel</b>";
         if($str == "laravel")
           return view('pages.laravel',['khoahoc'=>$khoahoc]);
         elseif($str == "php")
           return view('pages.php',['khoahoc'=>$khoahoc]);
    }


}
