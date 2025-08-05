<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromotionSeeder extends Seeder
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
                'status'=>'off',
                'video_id'=>'1',
                'title'=>'promotion title',
                'title_spanish'=>'promotion title S',
                'title_french'=>'promotion title F',
                'description'=>'promotion description',
                'description_spanish'=>'promotion description S',
                'description_french'=>'promotion description F',
                'image'=>'img.png',
                'video'=>'video.mp4',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ),
        );

        DB::table('promotions')->insert($data);
    }
}
