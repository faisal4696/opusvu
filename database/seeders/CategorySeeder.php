<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
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
                'name'=>'Hills',
                'name_spanish'=>'sierras',
                'name_french'=>'Collines',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ),
            array(
                'name'=>'Deserts',
                'name_spanish'=>'Desiertas',
                'name_french'=>'Déserts',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ),
            array(
                'name'=>'Sea',
                'name_spanish'=>'Mar',
                'name_french'=>'Mer',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ),
            array(
                'name'=>'Islands',
                'name_spanish'=>'Islas',
                'name_french'=>'îles',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ),
            array(
                'name'=>'Mountains',
                'name_spanish'=>'Montañas',
                'name_french'=>'Montagnes',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ),
            array(
                'name'=>'Buildings',
                'name_spanish'=>'Edificios',
                'name_french'=>'Bâtiments',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ),
            array(
                'name'=>'Cities',
                'name_spanish'=>'Ciudades',
                'name_french'=>'Villes',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ),
            array(
                'name'=>'Rivers',
                'name_spanish'=>'Ríos',
                'name_french'=>'Rivières',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ),
            array(
                'name'=>'Canals',
                'name_spanish'=>'Canales',
                'name_french'=>'Canaux',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ),
            array(
                'name'=>'Restaurents',
                'name_spanish'=>'Restaurantes',
                'name_french'=>'Restaurants',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ),
            array(
                'name'=>'Ship travel',
                'name_spanish'=>'Viaje en barco',
                'name_french'=>'Voyage en bateau',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ),
            array(
                'name'=>'Gavadar',
                'name_spanish'=>'Gavadar',
                'name_french'=>'Gavadar',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ),
            array(
                'name'=>'Other',
                'name_spanish'=>'Otra',
                'name_french'=>'Autre',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ),
        );

        DB::table('categories')->insert($data);
    }
}
