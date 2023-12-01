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
        Schema::create('reporte_del_reporte', function (Blueprint $table) {
            $table->id(); 
            $table->date('fecha');
            $table->string('solicitud_numero');
            $table->string('orden_servicio')->nullable();
            $table->string('area_solicitante');
            $table->text('descripcion_trabajo_realizado');
            $table->string('realizado_por');
            $table->string('supervisado_por')->nullable();
            $table->boolean('solucionado');
            $table->boolean('no_solucionado');
            $table->text('porque_no_solucionado')->nullable();
            $table->string('recibido_por');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reporte_del_reporte');
    }
};
