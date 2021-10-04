<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConvenienceStoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            [
                'name' => 'ファミリーマート 八幡平中央店',
                'convenience_store_category_id' => 2,
                'address' => '028-7111 岩手県八幡平市大更第２４地割８−３',
                'latitude' => 39.913329092587695,
                'longitude' => 141.09566805517923,
                'img_path' => 'images/01.jpeg',
                'pr' => '店員さんが、可愛かったり、そうじゃなかったり',
                'toilet' => 1,
                'parking' => 20,
            ],
            [
                'name' => 'ファミリーマート 八幡平西根インター店',
                'convenience_store_category_id' => 2,
                'address' => '028-7111 岩手県八幡平市大更第１地割２３０−１',
                'latitude' => 39.881611103743325,
                'longitude' => 141.09715783983543,
                'img_path' => 'images/02.jpeg',
                'pr' => '',
                'toilet' => 1,
                'parking' => 25,
            ],
            [
                'name' => 'セブンイレブン 八幡平野駄店',
                'convenience_store_category_id' => 1,
                'address' => '028-7301 岩手県八幡平市野駄第２１地割２２０−１',
                'latitude' => 39.95787425170508,
                'longitude' => 141.07005243983812,
                'img_path' => 'images/03.jpeg',
                'pr' => '',
                'toilet' => 1,
                'parking' => 30,
            ],
            [
                'name' => 'セブンイレブン 八幡平バイパス店',
                'convenience_store_category_id' => 1,
                'address' => '028-7111 岩手県八幡平市大更第３６地割４６９−１',
                'latitude' => 39.92367373851811,
                'longitude' => 141.1054362840152,
                'img_path' => 'images/04.jpeg',
                'pr' => '',
                'toilet' => 1,
                'parking' => 30,
            ],
            [
                'name' => 'ローソン 八幡平安代インター店',
                'convenience_store_category_id' => 3,
                'address' => '028-7535 岩手県八幡平市清水７０−１',
                'latitude' => 40.10687466781741,
                'longitude' => 141.05101166867917,
                'img_path' => 'images/05.jpeg',
                'pr' => '',
                'toilet' => 1,
                'parking' => 30,
            ],
            [
                'name' => 'ローソン 八幡平西根バイパス店',
                'convenience_store_category_id' => 3,
                'address' => '028-7111 岩手県八幡平市大更第２６地割１８０−１',
                'latitude' => 39.91255195315427,
                'longitude' => 141.1067877128506,
                'img_path' => 'images/06.png',
                'pr' => '',
                'toilet' => 1,
                'parking' => 30,
            ],
            [
                'name' => 'ローソン 安比高原店',
                'convenience_store_category_id' => 3,
                'address' => '028-7306 岩手県八幡平市安比高原１８２−２２',
                'latitude' => 40.015136303296224,
                'longitude' => 140.9908962975115,
                'img_path' => 'images/07.jpeg',
                'pr' => '',
                'toilet' => 1,
                'parking' => 20,
            ],
            [
                'name' => 'ファミリーマート 西根大更店',
                'convenience_store_category_id' => 2,
                'address' => '028-7111 岩手県八幡平市大更第１６地割４−８９',
                'latitude' => 39.89873018424193,
                'longitude' => 141.09685982634315,
                'img_path' => 'images/08.jpeg',
                'pr' => '',
                'toilet' => 0,
                'parking' => 25,
            ],
            [
                'name' => 'セブンイレブン 鹿角八幡平店',
                'convenience_store_category_id' => 1,
                'address' => '018-5201 秋田県鹿角市花輪高井田４４−１５',
                'latitude' => 40.17556271957999,
                'longitude' => 140.78667831101018,
                'img_path' => 'images/09.jpeg',
                'pr' => '',
                'toilet' => 0,
                'parking' => 35,
            ],
        ];
        DB::table('convenience_stores')->insert($param);
    }
}
