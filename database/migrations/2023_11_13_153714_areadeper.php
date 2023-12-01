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
        Schema::create('areadeper', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('ubicacion'); // Agrega la clave foránea
            $table->integer('capacidad_maxima');
            $table->string('encargado_de_area');
            $table->timestamps();

        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('areadeper');//
    }
};
