<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CommunessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = faker::create();
        $ids_reg = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

        foreach (range(1, 10) as $index) {
            db::table('communes')->insert([
                'id_reg' => $faker->randomElement($ids_reg),
                'description' => $faker->text(90),
                'trash' => $faker->randomelement(['A', 'I']),
            ]);
        }
    }
}
