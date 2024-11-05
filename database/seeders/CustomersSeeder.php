<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        $ids = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

        foreach (range(1, 10) as $index) {
            db::table('customers')->insert([
                'dni' => $faker->randomNumber(8),
                'id_reg' => $faker->randomElement($ids),
                'id_com' => $faker->randomElement($ids),
                'email' => $faker->email,
                'name' => $faker->name,
                'last_name' => $faker->lastName,
                'address' => $faker->address,
                'date_reg' => now(),
                'trash' => $faker->randomelement(['A', 'I']),
            ]);
        }
    }
}
