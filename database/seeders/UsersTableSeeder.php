<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            "name"=>'admin',
            "email"=>'admin@gmail.com',
            "password"=>bcrypt('12345678'),
            "role_id"=>1,
        ]);
        
        DB::table('users')->insert([
            "name"=>'user',
            "email"=>'user@gmail.com',
            "password"=>bcrypt('12345678'),
            "role_id"=>2,
        ]);
    }
}
