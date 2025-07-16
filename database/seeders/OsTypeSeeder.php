<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OsTypeSeeder extends Seeder
{
    public function run(): void
    {

        DB::table('os_types')->insert([
            [
                'name'       => 'Android',
                'image_url'  => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d7/Android_robot.svg/1200px-Android_robot.svg.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'iOS',
                'image_url'  => 'https://static.vecteezy.com/system/resources/previews/021/496/368/non_2x/ios-icon-logo-software-phone-apple-symbol-with-name-black-design-mobile-illustration-free-vector.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
