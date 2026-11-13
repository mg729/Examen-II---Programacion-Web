@extends('layouts.app')
@section('title', 'Editar Proveedor')
@section('content')
<div class="card shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('proveedores.update', $proveedor) }}">
        @csrf
        @method('PUT')
        @include('proveedores._form')
        <div class="mt-4">
            <button class="btn btn-primary"><i class="bi bi-save"></i> Actualizar</button>
            <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div></div>
@endsection