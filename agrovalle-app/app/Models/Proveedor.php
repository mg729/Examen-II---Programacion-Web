<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';

    public const CATEGORIAS   = ['Quimicos', 'Semilleros', 'Maquinaria'];
    public const DIAS_CREDITO = [15, 30, 45, 60];

    protected $fillable = [
        'rtn', 'empresa', 'contacto', 'telefono', 'categoria',
        'limite_credito', 'dias_credito', 'estado', 'fecha_registro',
    ];

    protected $casts = [
        'limite_credito' => 'decimal:2',
        'fecha_registro' => 'date',
    ];
}