<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    public const CARGOS = [
        'Ingeniero Agronomo', 'Asesor Tecnico de Campo', 'Jefe de Bodega Central',
        'Operador de Maquinaria', 'Cajero',
    ];

    // Clase de color del badge según el cargo
    public const COLORES = [
        'Ingeniero Agronomo'      => 'bg-success',
        'Asesor Técnico de Campo' => 'bg-info text-dark',
        'Jefe de Bodega Central'  => 'bg-primary',
        'Operador de Maquinaria'  => 'bg-warning text-dark',
        'Cajero'                  => 'bg-secondary',
    ];

    protected $fillable = [
        'identidad', 'nombre', 'apellido', 'correo', 'cargo',
        'salario', 'fecha_ingreso', 'estado',
    ];

    protected $casts = [
        'salario'       => 'decimal:2',
        'fecha_ingreso' => 'date',
    ];
}