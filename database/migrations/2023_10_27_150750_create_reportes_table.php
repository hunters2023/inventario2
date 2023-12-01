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
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('numero');
            $table->string('area');
            $table->string('solicitante');
            $table->string('codigo');
            $table->string('infraestructura');
            $table->string('mobiliaria');
            $table->string('equipos_maquinarias');
            $table->text('detallar_parte');
            $table->integer('cantidad');
            $table->text('descripcion');
            $table->string('firma_del_responsable');
            $table->string('autorizado_por');
            $table->boolean('grave');
            $table->boolean('leve');
            $table->boolean('critica');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};
