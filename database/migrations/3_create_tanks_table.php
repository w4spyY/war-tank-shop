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
            $table->string('image_url')->nullable();
            $table->string('code')->unique();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->decimal('weight_kg', 10, 2);
            $table->integer('crew_capacity');
            $table->integer('fuel_capacity_liters');
            $table->string('fuel_type');
            $table->integer('horsepower');
            $table->string('ammunition_type');
            $table->decimal('max_speed_kmh', 10, 2);
            $table->decimal('price', 10, 2);
            $table->string('armor_type');
            $table->decimal('range_km', 10, 2);
            $table->integer('manufacture_year');
            $table->string('country');
            $table->integer('stock')->default(0);
            $table->integer('sells')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tanks');
    }
};
