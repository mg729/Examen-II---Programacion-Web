@extends('layouts.app')
@section('title', 'Nómina y Personal')

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('empleados.create') }}" class="btn btn-success">
        <i class="bi bi-plus-lg"></i> Nuevo empleado
    </a>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-success">
                <tr>
                    <th>Identidad</th><th>Nombre</th><th>Correo</th><th>Cargo</th>
                    <th>Salario</th><th>Ingreso</th><th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
            @forelse($empleados as $e)
                <tr>
                    <td>{{ $e->identidad }}</td>
                    <td>{{ $e->nombre }} {{ $e->apellido }}</td>
                    <td>{{ $e->correo }}</td>
                    <td>
                        <span class="badge {{ \App\Models\Empleado::COLORES[$e->cargo] ?? 'bg-secondary' }}">
                            {{ $e->cargo }}
                        </span>
                    </td>
                    <td>L. {{ number_format($e->salario, 2, '.', ',') }}</td>
                    <td>{{ $e->fecha_ingreso->format('d/m/Y') }}</td>
                    <td>
                        <span class="badge {{ $e->estado === 'Activo' ? 'bg-success' : 'bg-secondary' }}">
                            {{ $e->estado }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('empleados.edit', $e) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('empleados.destroy', $e) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('¿Eliminar a {{ $e->nombre }} {{ $e->apellido }}?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center text-muted py-4">No hay empleados registrados.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $empleados->links() }}</div>
@endsection