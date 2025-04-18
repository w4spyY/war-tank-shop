<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tanks = [
            [
                'name' => 'M1A2 Abrams',
                'description' => 'Tanque de batalla principal estadounidense con blindaje compuesto avanzado y sistema de control de fuego digital.',
                'capacity' => 4,
                'price' => 8500000.00,
                'stock' => 5,
                'color' => 'verde oliva',
                'fabrication' => 2022,
                'provider' => 'General Dynamics Land Systems',
                'img_url' => 'tanks/abrams.jpg',
                'category' => 'tanque principal',
                'condition' => 'nuevo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'T-14 Armata',
                'description' => 'Tanque ruso de última generación con torreta no tripulada y sistema de protección activa Afganit.',
                'capacity' => 3,
                'price' => 7200000.00,
                'stock' => 3,
                'color' => 'gris digital',
                'fabrication' => 2021,
                'provider' => 'Uralvagonzavod',
                'img_url' => 'tanks/armata.jpg',
                'category' => 'tanque principal',
                'condition' => 'nuevo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Leopard 2A7+',
                'description' => 'Versión mejorada del tanque alemán con kit de protección urbana y mayor movilidad en terrenos difíciles.',
                'capacity' => 4,
                'price' => 9100000.00,
                'stock' => 2,
                'color' => 'tricolor OTAN',
                'fabrication' => 2020,
                'provider' => 'Krauss-Maffei Wegmann',
                'img_url' => 'tanks/leopard.jpg',
                'category' => 'tanque principal',
                'condition' => 'seminuevo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Challenger 3',
                'description' => 'Modernización del tanque británico con nuevo cañón de 120mm y sistema de protección modular.',
                'capacity' => 4,
                'price' => 8800000.00,
                'stock' => 1,
                'color' => 'verde bosque',
                'fabrication' => 2023,
                'provider' => 'Rheinmetall BAE Systems Land',
                'img_url' => 'tanks/challenger.jpg',
                'category' => 'tanque principal',
                'condition' => 'nuevo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Type 99A',
                'description' => 'Tanque chino de tercera generación con sistema láser de alerta y protección reactiva.',
                'capacity' => 3,
                'price' => 6500000.00,
                'stock' => 4,
                'color' => 'verde militar',
                'fabrication' => 2021,
                'provider' => 'Norinco',
                'img_url' => 'tanks/type99.jpg',
                'category' => 'tanque principal',
                'condition' => 'nuevo',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        // Insertar los datos
        DB::table('tanks')->insert($tanks);
    }
}