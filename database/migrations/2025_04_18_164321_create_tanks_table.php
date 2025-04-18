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
        Schema::create('tanks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('capacity'); // Capacidad en litros o número de tripulantes
            $table->decimal('price', 10, 2); // Precio en millones de dólares
            $table->integer('stock')->default(0);
            $table->string('color')->nullable();
            $table->year('fabrication')->nullable(); // Año de fabricación
            $table->string('provider')->nullable(); // Proveedor/fabricante
            $table->string('img_url')->nullable(); // URL de la imagen
            $table->string('category')->nullable(); // Categoría (medio, pesado, etc.)
            $table->string('condition')->default('nuevo'); // nuevo, usado, restaurado
            $table->timestamps(); // Crea created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('war_tanks');
    }
};