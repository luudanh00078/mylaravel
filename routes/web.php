<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('KhoaHoc', function(){
    return "xin chao cac ban";
});
Route::get('LuuDanh/Laravel',function(){
    echo "<h1>Khoa Hoc - Laravel</h1>";
});
//truyen tham so
Route::get('LuuDanh/{abc}',function($abc){
    return $abc;
});
Route::get('Shanghai/{ngay}',function($ngay){
    echo "Luu Danh:" .$ngay;
})->where(['ngay'=>'[0-9]{5}']); //so co 5 chu so
//Bai7 Dinh danh Route 
//c1
Route::get('Route1',['as'=>'MyRoute',function(){
    echo "xin chao cac ban";
}]);
//c2
Route::get('Route2',function(){
    echo "Day la Route2";
})->name('MyRoute2');

Route::get('GoiTen',function(){
    return redirect()->route('MyRoute2');
});
//Group
Route::group(['prefix'=>'MyGroup'],function(){
    Route::get('User1',function(){
        echo "User1";
    });
    Route::get('User2',function(){
        echo "Day la User2";
    });
    Route::get('User3',function(){
        echo "User3";
    });
});
//Bai 8
//Goi Controller
Route::get('GoiController','MyController@XinChao');
//bai9
//truyen tham so qua controller

Route::get('ThamSo/{ten}','MyController@KhoaHoc');
//bai10 URL tren Request
Route::get('MyRequest','MyController@GetURL');
//bai11:gui nhan du lieu voi request
Route::get('getForm',function(){
    return view('postForm');
});
Route::post('postForm',['as'=>'postForm','uses'=>'MyController@postForm']);
//bai12 Cookie
Route::get('setCookie','MyController@setCookie');
Route::get('getCookie','MyController@getCookie');
//bai13 up file
Route::get('uploadFile',function(){
    return view('postFile');

});
Route::post('postFile',['as'=>'postFile','uses'=>'MyController@postFile']);
//bai15 Json
Route::get('getJson','MyController@getJson');
//bai16 View
Route::get('myView','MyController@getMyView');
//bai17
Route::get('Time/{t}','MyController@getView');
View::share('KhoaHoc','LDLaravel'); //dung chia se dung chung
//bai19 blade template
Route::get('blade',function(){
    return view('pages.laravel');
});
Route::get('php',function(){
    return view('pages.php');
});
//bai20
Route::get('Bladetemplate/{str}','MyController@blade');
//bai25
Route::get('database',function(){
    // Schema::create('loaisanpham',function($table){
    //     $table->increments('id');
    //     $table->string('ten',200);
    // });
    Schema::create('theloai',function($table){
        $table->increments('id');
        $table->string('ten',200)->nullable();
        $table->string('nsx')->default('Nha san xuat');
    });
    echo "Da thuc hien lenh tao bang";
});
//bai 26
Route::get('lienketbang',function(){
    Schema::create('sanpham',function($table){
        $table->increments('id');
        $table->string('ten');
        $table->float('gia');
        $table->integer('soluong')->default(0);
        $table->integer('id_loaisanpham')->unsigned();
        $table->foreign('id_loaisanpham')->references('id')->on('loaisanpham');
    });
    echo "da tao bang san pham";
});
//xoa cot trong bang
Route::get('suabang',function(){
    Schema::table('theloai',function($table){
        $table->dropColumn('nsx');
    });
});
//them cot trong bang
Route::get('themcot',function(){
    Schema::table('theloai',function($table){
        $table->string('Email');
    });
    echo "Da them cot Email";
});
//Doi ten bang
Route::get('doiten',function(){
    Schema::rename('theloai','nguoidung');
    echo "Da doi ten bang";
});
//Xoa bang
Route::get('xoabang',function(){
    //Schema::drop('nguoidung);
    Schema::dropIfExists('nguoidung');
    echo "Da xoa bang";
});
Route::get('taobang',function(){
    Schema::create('nguoidung',function($table){
        $table->increments('id');
        $table->string('ten',200)->nullable();
        $table->string('nsx')->default('Nha san xuat');
    });
});