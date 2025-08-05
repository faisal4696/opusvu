<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavouriteVideoSeeder extends Seeder
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
                'user_id'=>'2',
                'video_id'=>'1',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ),
            array(
                'user_id'=>'3',
                'video_id'=>'2',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ),
            array(
                'user_id'=>'4',
                'video_id'=>'3',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ),
        );

        DB::table('favourite_videos')->insert($data);
    }
}
