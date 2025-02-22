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
            $table->unsignedBigInteger('categoria_id'); // ID de la categoría proveniente de la API
            $table->string('identificador'); // Identificador único del registro
            $table->string('nombre'); // Nombre del registro
            $table->json('extra_data')->nullable(); // Campos dinámicos por categoría
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
