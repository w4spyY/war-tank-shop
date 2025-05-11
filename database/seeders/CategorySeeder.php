<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $categories = [
            [
                'name' => 'Tanques Clásicos',
                'type' => 'tank',
                'description' => 'Tanques históricos de la Segunda Guerra Mundial y conflictos posteriores',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Tanques Modernos',
                'type' => 'tank',
                'description' => 'Tanques de batalla principal actuales',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Tanques Experimentales',
                'type' => 'tank',
                'description' => 'Modelos experimentales y de nueva generación',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Torretas',
                'type' => 'part',
                'description' => 'Torretas para tanques de diferentes modelos',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Sistemas de Suspensión',
                'type' => 'part',
                'description' => 'Componentes de suspensión para tanques',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Cañones',
                'type' => 'part',
                'description' => 'Cañones principales y secundarios para tanques',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        DB::table('categories')->insert($categories);
    }
}