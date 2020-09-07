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
//bai30 31 32:queryBuilder
Route::get('qb/get',function(){
    $data = DB::table('users')->get();
    // var_dump($data);
    foreach($data as $row)
    {
        foreach($row as $key=>$value)
        {
            echo $key.":".$value."<br>";
        }
        echo "<hr>";
    }
});
//select * from users where id = 2
Route::get('qb/where',function(){
    $data = DB::table('users')->where('id','=',2)->get();
    // var_dump($data);
    foreach($data as $row)
    {
        foreach($row as $key=>$value)
        {
            echo $key.":".$value."<br>";
        }
        echo "<hr>";
    }    
});
//select id,name,email form ...
Route::get('qb/select',function(){
    $data = DB::table('users')->select(['id','name','email'])->where('id','=',2)->get();
    // var_dump($data);
    foreach($data as $row)
    {
        foreach($row as $key=>$value)
        {
            echo $key.":".$value."<br>";
        }
        echo "<hr>";
    }    
});
//select name as hoten from ..
Route::get('qb/raw',function(){
    $data = DB::table('users')->select(DB::raw('id,name as hoten,email'))->where('id','=',2)->get();
    // var_dump($data);
    foreach($data as $row)
    {
        foreach($row as $key=>$value)
        {
            echo $key.":".$value."<br>";
        }
        echo "<hr>";
    }    
});
//order by... 
Route::get('qb/orderby',function(){
    $data = DB::table('users')->select(DB::raw('id,name as hoten,email'))->where('id','>',1)->orderBy('id','desc')->get();
    // var_dump($data);
    foreach($data as $row)
    {
        foreach($row as $key=>$value)
        {
            echo $key.":".$value."<br>";
        }
        echo "<hr>";
    }    
});
//limit 2,5 'tu vi tri so 2 lay 5 phan tu'
Route::get('qb/orderbylimit',function(){
    $data = DB::table('users')->select(DB::raw('id,name as hoten,email'))->where('id','>',1)->orderBy('id','desc')->skip(1)->take(3)->get();
    // var_dump($data);
    foreach($data as $row)
    {
        foreach($row as $key=>$value)
        {
            echo $key.":".$value."<br>";
        }
        echo "<hr>";
    }    
});
//count
Route::get('qb/count',function(){
    $data = DB::table('users')->select(DB::raw('id,name as hoten,email'))->where('id','>',1)->orderBy('id','desc')->take(2)->get();
    // var_dump($data);
    echo $data->count(); 
    // foreach($data as $row)
    // {
    //     foreach($row as $key=>$value)
    //     {
    //         echo $key.":".$value."<br>";
    //     }
    //     echo "<hr>";
    // }    
});
//update
Route::get('qb/update',function(){
     DB::table('users')->where('id',1)->update(['name'=>'danh']);
    echo "update thanh cong";
});
//delete
Route::get('qb/delete',function(){
     DB::table('users')->where('id','=',1)->delete();   
    echo "da xoa thanh cong";
});
//xoa het data trong bang,chi muc ve 0
Route::get('qb/deletes',function(){
    $data = DB::table('users')->truncate();  
    echo "da xoa thanh cong";
});
//bai33 model
//tao moi doi tuong va save vao database
Route::get('model/save',function(){
    $user = new App\User();
    $user->name = "Mai";
    $user->email = "Mai@email.com";
    $user->password = "Mat Khau";
    $user->save();
    echo "Da thuc hien save()";

});
Route::get('model/query',function(){
    $user = App\User::find(4);
    echo $user->name;
});
//bai 34 truy van voi model
//insert demo
Route::get('model/sanpham/save/{ten}',function($ten){
    $sanpham = new App\SanPham();
    $sanpham->ten = $ten;
    $sanpham->soluong = 100;
    $sanpham->save();
    echo "da thuc hien save";
});
//lay het data trong bang
Route::get('model/sanpham/all',function(){
    $sanpham = App\SanPham::all()->toArray();
    var_dump($sanpham);
});
//lay san pham tuong ung voi ten
Route::get('model/sanpham/ten',function(){
    $sanpham = App\SanPham::where('ten','imac')->get()->toArray();
    echo $sanpham[0]['ten'];
});
//xoa san pham theo id
Route::get('model/sanpham/delete',function(){
    App\SanPham::destroy(5);
    echo "Da xoa";
});
//bai 35 tao lien ket model
Route::get('taocot',function(){
    Schema::table('sanpham',function($table){
        $table->integer('id_loaisanpham')->unsigned();
    });
});
Route::get('lienket',function(){
    $data = App\SanPham::find(4)->loaisanpham->toArray();
    var_dump($data);
});
Route::get('lienketloaisanpham',function(){
    $data = App\LoaiSanPham::find(1)->sanpham->toArray();
    var_dump($data);
});
//bai36 Middleware
Route::get('diem',function(){
    echo "Ban da du diem";
})->middleware('MyMiddle')->name('diem');
Route::get('loi',function(){
    echo "Ban chua du diem";
})->name('loi');
Route::get('nhapdiem',function(){
    return view('nhapdiem');
})->name('nhapdiem');
//bai 36 + 37 Auth
// Route::group(['middleware' => ['web']], function () {
//     //routes here
//     Route::get('dangnhap',function(){
//            return view('dangnhap');
//      });
//     Route::post('login','AuthController@login')->name('login');
// });
Route::get('dangnhap',function(){
    return view('dangnhap');
});
Route::post('login','AuthController@login')->name('login');

Route::get('logout','AuthController@logout')->name('logout');
