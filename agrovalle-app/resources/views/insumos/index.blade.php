@extends('layouts.app')
@section('title', 'Catálogo de Insumos')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
    <form method="GET" action="{{ route('insumos.index') }}" class="d-flex gap-2">
        <input type="text" name="buscar" value="{{ $buscar }}" class="form-control" placeholder="Buscar por nombre o SKU">
        <button class="btn btn-outline-success"><i class="bi bi-search"></i></button>
    </form>
    <a href="{{ route('insumos.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i> Nuevo insumo</a>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-success">
                <tr>
                    <th>Foto</th><th>SKU</th><th>Nombre</th><th>Categoría</th>
                    <th>Precio</th><th>Existencias</th><th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
            @forelse($insumos as $i)
                <tr>
                    <td>
                        @if($i->imagen)
                            <img src="{{ asset('uploads/insumos/' . $i->imagen) }}" alt="{{ $i->nombre }}"
                                 width="50" height="50" class="rounded object-fit-cover">
                        @else
                            <i class="bi bi-image text-muted fs-3"></i>
                        @endif
                    </td>
                    <td>{{ $i->codigo }}</td>
                    <td>{{ $i->nombre }}</td>
                    <td>{{ $i->categoria }}</td>
                    <td>L. {{ number_format($i->precio, 2) }}</td>
                    <td>
                        @if($i->inventario > 20)
                            <span class="badge bg-success">{{ $i->inventario }} Óptimo</span>
                        @elseif($i->inventario >= 10)
                            <span class="badge bg-warning text-dark">{{ $i->inventario }} Moderado</span>
                        @else
                            <span class="badge bg-danger">{{ $i->inventario }} ¡Desabastecimiento!</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('insumos.edit', $i) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('insumos.destroy', $i) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('¿Seguro que desea eliminar el insumo {{ $i->nombre }}?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-muted py-4">No se encontraron insumos.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $insumos->links() }}</div>
@endsection