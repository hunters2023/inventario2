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
        Schema::create('cpu', function (Blueprint $table) {
            $table->id();
            $table->string('ubicacion');
            $table->string('marca');
            $table->string('modelo');
            $table->string('numero_serie');
            $table->string('codigo_inventario');
            $table->string('procesador');
            $table->string('disco_duro');
            $table->string('memoria_ram');
            $table->string('tarjeta_inalambrica');
            $table->string('tarjeta_video');
            $table->string('sistema_operativo');
            $table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cpu');
    }
};
