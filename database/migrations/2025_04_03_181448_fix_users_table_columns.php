<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Verificar y agregar solo las columnas que no existen
            if (!Schema::hasColumn('users', 'lastname')) {
                $table->string('lastname')->after('name');
            }
            if (!Schema::hasColumn('users', 'nacimiento')) {
                $table->date('nacimiento')->default('2000-01-01')->after('lastname');
            }
            if (!Schema::hasColumn('users', 'direccion')) {
                $table->string('direccion')->after('password');
            }
            if (!Schema::hasColumn('users', 'facturacion')) {
                $table->string('facturacion')->after('direccion');
            }
            if (!Schema::hasColumn('users', 'telefono')) {
                $table->string('telefono')->after('facturacion');
            }
            if (!Schema::hasColumn('users', 'terms_accepted')) {
                $table->boolean('terms_accepted')->after('telefono');
            }
            if (!Schema::hasColumn('users', 'cookies_accepted')) {
                $table->boolean('cookies_accepted')->after('terms_accepted');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
