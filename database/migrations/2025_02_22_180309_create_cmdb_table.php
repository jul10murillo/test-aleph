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
            $table->unsignedBigInteger('categoria_id')->comments('ID de la categoría a la que pertenece el registro');
            $table->string('identificador')->unique()->comments('Identificador del registro');
            $table->string('nombre')->comments('Nombre del registro');
            $table->json('extra_data')->nullable()->comments('Datos adicionales del registro');
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
