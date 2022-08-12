<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insertOrIgnore([
            [
                'id' => 1,
                'name' => 'Работа',
            ],
            [
                'id' => 2,
                'name' => 'Хобби',
            ],
            [
                'id' => 3,
                'name' => 'Дом',
            ],
            [
                'id' => 4,
                'name' => 'Новая категория',
            ]
        ]);
    }
}
