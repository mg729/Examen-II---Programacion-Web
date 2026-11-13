<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Insumo;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalInsumos      = Insumo::count();
        $proveedoresActivos = Proveedor::where('estado', 'Activo')->count();
        $empleadosNomina   = Empleado::where('estado', 'Activo')->count();
        $valorInventario   = Insumo::sum(DB::raw('inventario * precio'));

        return view('dashboard', compact(
            'totalInsumos', 'proveedoresActivos', 'empleadosNomina', 'valorInventario'
        ));
    }
}
