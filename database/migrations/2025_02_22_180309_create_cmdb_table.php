<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cmdb', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoria_id'); // Asegurar que esta columna existe
            $table->string('identificador')->unique();
            $table->string('nombre');
            $table->json('extra_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cmdb');
    }
};
