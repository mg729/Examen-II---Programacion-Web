@extends('layouts.app')
@section('title', 'Fabricantes y Proveedores')

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('proveedores.create') }}" class="btn btn-success">
        <i class="bi bi-plus-lg"></i> Nuevo proveedor
    </a>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-success">
                <tr>
                    <th>RTN</th><th>Empresa</th><th>Contacto</th><th>Teléfono</th>
                    <th>Categoría</th><th>Límite crédito</th><th>Plazo</th><th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
            @forelse($proveedores as $p)
                <tr>
                    <td>{{ $p->rtn }}</td>
                    <td>{{ $p->empresa }}</td>
                    <td>{{ $p->contacto }}</td>
                    <td>{{ $p->telefono }}</td>
                    <td>{{ $p->categoria }}</td>
                    <td>L. {{ number_format($p->limite_credito, 2, '.', ',') }}</td>
                    <td><span class="badge bg-info text-dark">{{ $p->dias_credito }} días</span></td>
                    <td>
                        @if($p->estado === 'Activo')
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-secondary">Inactivo</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('proveedores.edit', $p) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('proveedores.destroy', $p) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('¿Eliminar al proveedor {{ $p->empresa }}?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="9" class="text-center text-muted py-4">No hay proveedores registrados.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $proveedores->links() }}</div>
@endsection