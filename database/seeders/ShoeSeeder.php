<?php

namespace Database\Seeders;

use App\Models\Shoe;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShoeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 50; $i++) {
            $shoe = new Shoe;
            $shoe->brand = $faker->company();
            $shoe->model = $faker->streetName();
            $shoe->material = $faker->word();
            $shoe->image = 'https://picsum.photos/800/1000?random=' . $i;
            $shoe->color = $faker->colorName();
            $shoe->price = $faker->randomFloat(2, 10, 9999);
            $shoe->description = $faker->paragraph(5);
            $shoe->is_available = $faker->boolean();
            $shoe->save();
        }
    }
}
