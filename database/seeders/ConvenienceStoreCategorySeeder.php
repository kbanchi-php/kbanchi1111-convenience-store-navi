<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConvenienceStoreCategorySeeder extends Seeder
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
                'name' => 'セブンイレブン',
                'img_path' => 'images/seven.png',
            ],
            [
                'name' => 'ファミリーマート',
                'img_path' => 'images/fami.jpeg',
            ],
            [
                'name' => 'ローソン',
                'img_path' => 'images/lowson.jpeg',
            ],
        ];
        DB::table('convenience_store_categories')->insert($param);
    }
}
