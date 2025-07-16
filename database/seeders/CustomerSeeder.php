<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $records = [];
        for ($i = 0; $i < 5; $i++) {
            $records[] = [
                'name'       => $faker->name(),
                'email'      => $faker->unique()->safeEmail(),
                'phone'      => $faker->phoneNumber(),
                'address'    => $faker->address(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('customers')->insert($records);
    }
}
