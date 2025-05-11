<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tanks_parts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->string('material');
            $table->text('compatibility_notes')->nullable();
            $table->decimal('weight_kg', 10, 2);
            $table->decimal('price', 10, 2);
            $table->integer('stock')->default(0);
            $table->integer('sells')->default(0);
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tanks_parts');
    }
};
