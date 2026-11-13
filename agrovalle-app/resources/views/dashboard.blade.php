@extends('layouts.app')
@section('title', 'Dashboard Gerencial')

@section('content')
<div class="row g-4">
    <div class="col-12 col-md-6 col-xl-3">
        <div class="card border-0 shadow-sm border-start border-success border-4 h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase">Insumos en catalogo</div>
                    <div class="fs-2 fw-bold">{{ $totalInsumos }}</div>
                </div>
                <i class="bi bi-box-seam fs-1 text-success"></i>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
        <div class="card border-0 shadow-sm border-start border-primary border-4 h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase">Proveedores activos</div>
                    <div class="fs-2 fw-bold">{{ $proveedoresActivos }}</div>
                </div>
                <i class="bi bi-truck fs-1 text-primary"></i>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
        <div class="card border-0 shadow-sm border-start border-warning border-4 h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase">Empleados en nomina</div>
                    <div class="fs-2 fw-bold">{{ $empleadosNomina }}</div>
                </div>
                <i class="bi bi-people fs-1 text-warning"></i>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
        <div class="card border-0 shadow-sm border-start border-danger border-4 h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small text-uppercase">Valor del inventario</div>
                    <div class="fs-4 fw-bold">L. {{ number_format($valorInventario, 2, '.', ',') }}</div>
                </div>
                <i class="bi bi-cash-coin fs-1 text-danger"></i>
            </div>
        </div>
    </div>
</div>
@endsection