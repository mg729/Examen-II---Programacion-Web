@extends('layouts.app')
@section('title', 'Editar Empleado')
@section('content')
<div class="card shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('empleados.update', $empleado) }}">
        @csrf
        @method('PUT')
        @include('empleados._form')
        <div class="mt-4">
            <button class="btn btn-primary"><i class="bi bi-save"></i> Actualizar</button>
            <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div></div>
@endsection