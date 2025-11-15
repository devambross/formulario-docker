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
        Schema::table('registros', function (Blueprint $table) {
            // Eliminar campos que ya no se usan
            $table->dropColumn(['apellidos', 'edad']);

            // Modificar campo nombres para que sea "Nombres y Apellidos"
            // Ya existe, solo lo renombramos conceptualmente en la vista

            // Agregar nuevos campos
            $table->boolean('acepta_terminos')->default(false)->after('codigo_socio');
            $table->string('fecha_preferencia')->after('telefono');
            $table->enum('tipo_bungalow', ['6_personas', '9_personas'])->after('fecha_preferencia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registros', function (Blueprint $table) {
            $table->dropColumn(['acepta_terminos', 'fecha_preferencia', 'tipo_bungalow']);
            $table->string('apellidos')->after('nombres');
            $table->integer('edad')->after('telefono');
        });
    }
};
