<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=array(
            array(
                'name'=>'Admin',
                'email'=>'admin@gmail.com',
                'password'=>Hash::make('123456'),
                'role'=>'1',
                'language'=>'english',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ),
            array(
                'name'=>'Faisal',
                'email'=>'faisal@gmail.com',
                'password'=>Hash::make('123456'),
                'role'=>'0',
                'language'=>'english',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ),
            array(
                'name'=>'Umer',
                'email'=>'umer@gmail.com',
                'password'=>Hash::make('123456'),
                'role'=>'0',
                'language'=>'english',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ),
            array(
                'name'=>'Hammad',
                'email'=>'hammad@gmail.com',
                'password'=>Hash::make('123456'),
                'role'=>'0',
                'language'=>'english',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ),
        );

        DB::table('users')->insert($data);
    }
}
