<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tanks', function (Blueprint $table) {
            $table->id();
            $table->text('image_url')->nullable();
            $table->string('name', 150);
            $table->text('description')->nullable();
            $table->decimal('weight_kg', 10, 2)->nullable();
            $table->integer('crew_capacity')->nullable();
            $table->integer('fuel_capacity_liters')->nullable();
            $table->string('fuel_type', 50)->nullable();
            $table->integer('horsepower')->nullable();
            $table->string('ammunition_type', 100)->nullable();
            $table->decimal('max_speed_kmh', 5, 2)->nullable();
            $table->decimal('price', 15, 2);
            $table->string('armor_type', 100)->nullable();
            $table->integer('range_km')->nullable();
            $table->year('manufacture_year')->nullable();
            $table->string('country', 100)->nullable();
            $table->enum('category', ['normal', 'sale', 'outlet', 'limited', 'experimental'])->default('normal');
            $table->integer('stock')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tanks');
    }
};