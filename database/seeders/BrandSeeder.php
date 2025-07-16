<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Samsung',
                'image_url' => 'data:image/png;base64,iVBORw0K...',
            ],
            [
                'name' => 'Apple',
                'image_url' => 'https://yt3.googleusercontent.com/t4LKRr...',
            ],
            [
                'name' => 'Xiaomi',
                'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS8Pfq44...',
            ],
            [
                'name' => 'OPPO',
                'image_url' => 'https://cdn-icons-png.flaticon.com/512/5968/5968992.png',
            ],
            [
                'name' => 'realme',
                'image_url' => 'https://www.logo.wine/a/logo/Oppo/Oppo-Logo.wine.svg',
            ],
            [
                'name' => 'Vivo',
                'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRIHTog...',
            ],
            [
                'name' => 'Google',
                'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdfv5...',
            ],
            [
                'name' => 'Huawei',
                'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQimEZ...',
            ],
        ];

        $now = Carbon::now();

        foreach ($brands as &$brand) {
            $brand['slug'] = Str::slug($brand['name']);
            $brand['created_at'] = $now;
            $brand['updated_at'] = $now;
        }

        DB::table('brands')->insert($brands);
    }
}
