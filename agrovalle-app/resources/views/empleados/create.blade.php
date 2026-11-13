@extends('layouts.app')
@section('title', 'Nuevo Empleado')
@section('content')
<div class="card shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('empleados.store') }}">
        @csrf
        @include('empleados._form')
        <div class="mt-4">
            <button class="btn btn-success"><i class="bi bi-save"></i> Guardar</button>
            <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div></div>
@endsection