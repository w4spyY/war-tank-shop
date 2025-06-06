<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            PromoCategorySeeder::class,
            TankSeeder::class,
            TankPartSeeder::class,
            AdminUserSeeder::class,
            SalesSeeder::class,
            UserOrdersSeeder::class,
        ]);
    }
}
