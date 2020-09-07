<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(userSeeder::class);
    }
}
//bai 29 them du lieu mau vowis Seed
class userSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            ['name'=>'Danh','email'=>'luudanh00@gmail.com','password'=>bcrypt('matkhau')],
            ['name'=>'DanhLuu','email'=>'danh00@gmail.com','password'=>bcrypt('matkhau')],
            ['name'=>'Luu','email'=>'luu01@gmail.com','password'=>bcrypt('matkhau')],
            ['name'=>'HoangLinh','email'=>'luulinhhoang00@gmail.com','password'=>bcrypt('matkhau')]
        ]);
    }
}

