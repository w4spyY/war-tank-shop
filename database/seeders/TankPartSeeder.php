<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TankPartSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        $imagePath = 'test/part1.jpg';

        // Obtener IDs de categorías para partes
        $turretsCategory = DB::table('categories')->where('name', 'Torretas')->first()->id;
        $suspensionCategory = DB::table('categories')->where('name', 'Sistemas de Suspensión')->first()->id;
        $cannonsCategory = DB::table('categories')->where('name', 'Cañones')->first()->id;

        $parts = [
            // Torretas
            [
                'code' => 'TURRET-001',
                'category_id' => $turretsCategory,
                'name' => 'Torreta T-34',
                'description' => 'Torreta original del tanque T-34/76, incluye anillo de rotación.',
                'material' => 'Acero fundido',
                'compatibility_notes' => 'Compatible con modelos T-34/76 de 1940-1942',
                'weight_kg' => 3200.00,
                'price' => 12500.00,
                'stock' => 5,
                'sells' => 0,
                'image_url' => $imagePath,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'TURRET-002',
                'category_id' => $turretsCategory,
                'name' => 'Torreta M4 Sherman',
                'description' => 'Torreta para M4 Sherman con montaje para cañón de 75mm.',
                'material' => 'Acero laminado',
                'compatibility_notes' => 'Para modelos M4, M4A1, M4A2',
                'weight_kg' => 3800.00,
                'price' => 14500.00,
                'stock' => 3,
                'sells' => 0,
                'image_url' => $imagePath,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Sistemas de suspensión
            [
                'code' => 'SUSP-001',
                'category_id' => $suspensionCategory,
                'name' => 'Kit suspensión Christie',
                'description' => 'Sistema de suspensión tipo Christie para tanques soviéticos.',
                'material' => 'Acero y caucho',
                'compatibility_notes' => 'Para T-34, BT series',
                'weight_kg' => 850.00,
                'price' => 6200.00,
                'stock' => 8,
                'sells' => 0,
                'image_url' => $imagePath,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'SUSP-002',
                'category_id' => $suspensionCategory,
                'name' => 'Barras de torsión Tiger I',
                'description' => 'Juego completo de barras de torsión para Tiger I.',
                'material' => 'Acero aleado',
                'compatibility_notes' => 'Solo para Tiger I y Tiger (P)',
                'weight_kg' => 1200.00,
                'price' => 9800.00,
                'stock' => 2,
                'sells' => 0,
                'image_url' => $imagePath,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // Cañones
            [
                'code' => 'GUN-001',
                'category_id' => $cannonsCategory,
                'name' => 'Cañón 76.2mm F-34',
                'description' => 'Cañón principal de 76.2mm modelo F-34 para T-34/76.',
                'material' => 'Acero de alta resistencia',
                'compatibility_notes' => 'Para T-34/76 modelos 1941-1943',
                'weight_kg' => 1150.00,
                'price' => 22500.00,
                'stock' => 4,
                'sells' => 0,
                'image_url' => $imagePath,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'GUN-002',
                'category_id' => $cannonsCategory,
                'name' => 'Cañón 88mm KwK 36',
                'description' => 'Famoso cañón alemán de 88mm usado en el Tiger I.',
                'material' => 'Acero especial',
                'compatibility_notes' => 'Para Tiger I, incluye mecanismo de retroceso',
                'weight_kg' => 1350.00,
                'price' => 32000.00,
                'stock' => 1,
                'sells' => 0,
                'image_url' => $imagePath,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'GUN-003',
                'category_id' => $cannonsCategory,
                'name' => 'Cañón 120mm L44 M256',
                'description' => 'Cañón principal del M1A2 Abrams, versión mejorada.',
                'material' => 'Acero con revestimiento de cromo',
                'compatibility_notes' => 'Para M1A1, M1A2 Abrams. No incluye montaje.',
                'weight_kg' => 1800.00,
                'price' => 185000.00,
                'stock' => 3,
                'sells' => 0,
                'image_url' => $imagePath,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('tanks_parts')->insert($parts);
    }
}