<?php

namespace Database\Factories;

use App\Models\ConvenienceStore;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ConvenienceStoreCategory;
use Illuminate\Support\Arr;

class ConvenienceStoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ConvenienceStore::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create('ja_JP');

        $images = ['images/seven.png', 'images/fami.jpeg', 'images/lowson.jpeg'];

        return [
            'name' => $faker->company(),
            'convenience_store_category_id' => Arr::random(Arr::pluck(ConvenienceStoreCategory::all(), 'id')),
            'address' => $faker->address(),
            'latitude' => $faker->latitude($min = 26, $max = 43),
            'longitude' => $faker->longitude($min = 127.7, $max = 141.6),
            'img_path' => $images[array_rand($images)],
            'pr' => $faker->paragraph(),
            'toilet' => $faker->boolean(),
            'parking' => rand(5, 30),
        ];
    }
}
