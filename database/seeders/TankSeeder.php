<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TankSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        $imagePath = 'test/tank1.jpg';

        $classicCategory = DB::table('categories')->where('name', 'Tanques Clásicos')->first()->id;
        $modernCategory = DB::table('categories')->where('name', 'Tanques Modernos')->first()->id;
        $experimentalCategory = DB::table('categories')->where('name', 'Tanques Experimentales')->first()->id;

        $tanks = [
            [
                'image_url' => $imagePath,
                'code' => 'T34-76-001',
                'category_id' => $classicCategory,
                'name' => 'T-34/76',
                'description' => 'Tanque medio soviético de la Segunda Guerra Mundial, famoso por su diseño simple y efectivo.',
                'weight_kg' => 26500,
                'crew_capacity' => 4,
                'fuel_capacity_liters' => 460,
                'fuel_type' => 'Diesel',
                'horsepower' => 500,
                'ammunition_type' => '76.2mm',
                'max_speed_kmh' => 53.00,
                'price' => 250000.00,
                'armor_type' => 'Acero laminado',
                'range_km' => 300,
                'manufacture_year' => 1940,
                'country' => 'Unión Soviética',
                'stock' => 0,
                'sells' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'image_url' => $imagePath,
                'code' => 'M4-SHERMAN-002',
                'category_id' => $classicCategory,
                'name' => 'M4 Sherman',
                'description' => 'Tanque medio estadounidense, el más producido por los aliados durante la Segunda Guerra Mundial.',
                'weight_kg' => 33650,
                'crew_capacity' => 5,
                'fuel_capacity_liters' => 660,
                'fuel_type' => 'Gasolina',
                'horsepower' => 400,
                'ammunition_type' => '75mm',
                'max_speed_kmh' => 48.00,
                'price' => 275000.00,
                'armor_type' => 'Acero laminado',
                'range_km' => 240,
                'manufacture_year' => 1942,
                'country' => 'Estados Unidos',
                'stock' => 0,
                'sells' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'image_url' => $imagePath,
                'code' => 'TIGER-I-003',
                'category_id' => $classicCategory,
                'name' => 'Tiger I',
                'description' => 'Tanque pesado alemán de la Segunda Guerra Mundial, temido por su poderoso cañón y grueso blindaje.',
                'weight_kg' => 57000,
                'crew_capacity' => 5,
                'fuel_capacity_liters' => 540,
                'fuel_type' => 'Gasolina',
                'horsepower' => 700,
                'ammunition_type' => '88mm',
                'max_speed_kmh' => 45.00,
                'price' => 850000.00,
                'armor_type' => 'Acero laminado',
                'range_km' => 195,
                'manufacture_year' => 1942,
                'country' => 'Alemania',
                'stock' => 0,
                'sells' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'image_url' => $imagePath,
                'code' => 'M1A2-ABRAMS-004',
                'category_id' => $modernCategory,
                'name' => 'M1A2 Abrams',
                'description' => 'Tanque de batalla principal estadounidense, uno de los más avanzados del mundo.',
                'weight_kg' => 63500,
                'crew_capacity' => 4,
                'fuel_capacity_liters' => 1900,
                'fuel_type' => 'JP-8 (Turbosina)',
                'horsepower' => 1500,
                'ammunition_type' => '120mm',
                'max_speed_kmh' => 67.00,
                'price' => 8500000.00,
                'armor_type' => 'Composite Chobham',
                'range_km' => 425,
                'manufacture_year' => 1992,
                'country' => 'Estados Unidos',
                'stock' => 12,
                'sells' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'image_url' => $imagePath,
                'code' => 'LEOPARD-2A7-005',
                'category_id' => $modernCategory,
                'name' => 'Leopard 2A7',
                'description' => 'Versión más moderna del tanque alemán Leopard 2, con mejoras en protección y sistemas.',
                'weight_kg' => 67500,
                'crew_capacity' => 4,
                'fuel_capacity_liters' => 1200,
                'fuel_type' => 'Diesel',
                'horsepower' => 1500,
                'ammunition_type' => '120mm',
                'max_speed_kmh' => 72.00,
                'price' => 9200000.00,
                'armor_type' => 'Composite modular',
                'range_km' => 450,
                'manufacture_year' => 2014,
                'country' => 'Alemania',
                'stock' => 8,
                'sells' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'image_url' => $imagePath,
                'code' => 'T14-ARMATA-006',
                'category_id' => $experimentalCategory,
                'name' => 'T-14 Armata',
                'description' => 'Tanque de nueva generación ruso con torreta deshabitada y diseño revolucionario.',
                'weight_kg' => 48000,
                'crew_capacity' => 3,
                'fuel_capacity_liters' => 1600,
                'fuel_type' => 'Diesel',
                'horsepower' => 1500,
                'ammunition_type' => '125mm',
                'max_speed_kmh' => 80.00,
                'price' => 7800000.00,
                'armor_type' => 'Composite Malachit',
                'range_km' => 500,
                'manufacture_year' => 2015,
                'country' => 'Rusia',
                'stock' => 2,
                'sells' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'image_url' => $imagePath,
                'code' => 'CHALLENGER-2-007',
                'category_id' => $modernCategory,
                'name' => 'Challenger 2',
                'description' => 'Tanque de batalla principal británico, conocido por su excelente protección.',
                'weight_kg' => 62500,
                'crew_capacity' => 4,
                'fuel_capacity_liters' => 1592,
                'fuel_type' => 'Diesel',
                'horsepower' => 1200,
                'ammunition_type' => '120mm',
                'max_speed_kmh' => 59.00,
                'price' => 6500000.00,
                'armor_type' => 'Composite Dorchester',
                'range_km' => 450,
                'manufacture_year' => 1998,
                'country' => 'Reino Unido',
                'stock' => 4,
                'sells' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'image_url' => $imagePath,
                'code' => 'TYPE-99A-008',
                'category_id' => $modernCategory,
                'name' => 'Type 99A',
                'description' => 'Tanque chino de tercera generación con avanzados sistemas de control de fuego.',
                'weight_kg' => 55000,
                'crew_capacity' => 3,
                'fuel_capacity_liters' => 1300,
                'fuel_type' => 'Diesel',
                'horsepower' => 1500,
                'ammunition_type' => '125mm',
                'max_speed_kmh' => 80.00,
                'price' => 5800000.00,
                'armor_type' => 'Composite modular',
                'range_km' => 500,
                'manufacture_year' => 2011,
                'country' => 'China',
                'stock' => 6,
                'sells' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('tanks')->insert($tanks);
    }
}