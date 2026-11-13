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
    Schema::create('empleados', function (Blueprint $table) {
        $table->id();
        $table->string('identidad', 13)->unique();   // DNI sin guiones
        $table->string('nombre', 80);
        $table->string('apellido', 80);
        $table->string('correo', 120)->unique();
        $table->enum('cargo', [
            'Ingeniero Agrónomo', 'Asesor Técnico de Campo', 'Jefe de Bodega Central',
            'Operador de Maquinaria', 'Cajero',
        ]);
        $table->decimal('salario', 10, 2);
        $table->date('fecha_ingreso');
        $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
