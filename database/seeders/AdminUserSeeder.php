<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'lastname' => 'Principal',
            'nacimiento' => '2000-01-01', // Fecha de nacimiento
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'), // Contraseña segura
            'direccion' => 'Calle Admin 123, Ciudad',
            'facturacion' => 'Calle Admin 123, Ciudad',
            'telefono' => '+34666555444',
            'terms_accepted' => 1,
            'cookies_accepted' => 1,
            'role' => 'admin',
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $this->command->info('Usuario administrador creado exitosamente!');
    }
}