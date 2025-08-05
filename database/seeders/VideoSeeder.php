<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideoSeeder extends Seeder
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
                'category_id'=>'1',
                'title'=>'vide title one',
                'title_spanish'=>'video título uno',
                'title_french'=>'titre vide un',
                'description'=>'vide description',
                'description_spanish'=>'descripción de video',
                'description_french'=>'description de la vidéo',
                'thumbnail'=>'video thumbnail',
                'attachment'=>'video attachment',
                'duration'=>'00:00:00',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ),
            array(
                'category_id'=>'2',
                'title'=>'vide title two',
                'title_spanish'=>'video título dos',
                'title_french'=>'titre de la vidéo deux',
                'description'=>'vide description',
                'description_spanish'=>'descripción de video',
                'description_french'=>'description de la vidéo',
                'thumbnail'=>'video thumbnail',
                'attachment'=>'video attachment',
                'duration'=>'00:00:00',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ),
            array(
                'category_id'=>'3',
                'title'=>'vide title three',
                'title_spanish'=>'video título tres',
                'title_french'=>'titre de la vidéo trois',
                'description'=>'vide description',
                'description_spanish'=>'descripción de video',
                'description_french'=>'description de la vidéo',
                'thumbnail'=>'video thumbnail',
                'attachment'=>'video attachment',
                'duration'=>'00:00:00',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ),
            array(
                'category_id'=>'4',
                'title'=>'vide title four',
                'title_spanish'=>'video título cuatro',
                'title_french'=>'titre de la vidéo quatre',
                'description'=>'vide description',
                'description_spanish'=>'descripción de video',
                'description_french'=>'description de la vidéo',
                'thumbnail'=>'video thumbnail',
                'attachment'=>'video attachment',
                'duration'=>'00:00:00',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ),
        );

        DB::table('Videos')->insert($data);
    }
}
