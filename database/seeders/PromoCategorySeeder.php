<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PromoCategorySeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $categories = [
            [
                'name' => 'Tanques Outlet',
                'type' => 'tank',
                'description' => 'Tanques de Outlet',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Tanques Ofertas',
                'type' => 'tank',
                'description' => 'Tanques por precios casi REGALADOS',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Tanques Black Friday',
                'type' => 'tank',
                'description' => 'Si, tenemos BLACK FRIDAY de tanques',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Tanques Ofertas Navidad',
                'type' => 'tank',
                'description' => 'El mejor regalo para tu pareja masculina',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Tanques Ofertas Verano',
                'type' => 'tank',
                'description' => 'LLega el verano y los tanques con el aire acondicionado dentro',
                'created_at' => $now,
                'updated_at' => $now
            ],

            
            [
                'name' => 'Torretas Outlet',
                'type' => 'part',
                'description' => 'Torretas de Outlet',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Torretas Ofertas',
                'type' => 'part',
                'description' => 'Torretas por precios casi REGALADOS',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Torretas Black Friday',
                'type' => 'part',
                'description' => 'Si, tenemos BLACK FRIDAY de torretas',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Torretas Ofertas Navidad',
                'type' => 'part',
                'description' => 'El mejor regalo para tu pareja masculina',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Torretas Ofertas Verano',
                'type' => 'part',
                'description' => 'LLega el verano y las torretas con sistema de enfriamiento extra',
                'created_at' => $now,
                'updated_at' => $now
            ],


            [
                'name' => 'Sistemas de Suspensión Outlet',
                'type' => 'part',
                'description' => 'Componentes de suspensión para tanques',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Sistemas de Suspensión Ofertas',
                'type' => 'part',
                'description' => 'Componentes de suspensión para tanques por precios casi REGALADOS',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Sistemas de Suspensión Black Friday',
                'type' => 'part',
                'description' => 'Si, tenemos BLACK FRIDAY de suspensión para tanques',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Sistemas de Suspensión Ofertas Navidad',
                'type' => 'part',
                'description' => 'El mejor regalo para tu pareja masculina',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Sistemas de Suspensión Ofertas Verano',
                'type' => 'part',
                'description' => 'LLega el verano y sistemas de suspensión con mejor resistencia al calor',
                'created_at' => $now,
                'updated_at' => $now
            ],


            [
                'name' => 'Cañones Outlet',
                'type' => 'part',
                'description' => 'Cañones principales y secundarios para tanques',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Cañones Ofertas',
                'type' => 'part',
                'description' => 'Cañones por precios casi REGALADOS',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Cañones Black Friday',
                'type' => 'part',
                'description' => 'Si, tenemos BLACK FRIDAY de cañones',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Cañones Ofertas Navidad',
                'type' => 'part',
                'description' => 'El mejor regalo para tu pareja masculina',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Cañones Ofertas Verano',
                'type' => 'part',
                'description' => 'LLega el verano y los cañones con potencia extra caliente',
                'created_at' => $now,
                'updated_at' => $now
            ],


        ];

        DB::table('categories')->insert($categories);
    }
}