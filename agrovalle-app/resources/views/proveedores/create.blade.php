@extends('layouts.app')
@section('title', 'Nuevo Proveedor')
@section('content')
<div class="card shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('proveedores.store') }}">
        @csrf
        @include('proveedores._form')
        <div class="mt-4">
            <button class="btn btn-success"><i class="bi bi-save"></i> Guardar</button>
            <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div></div>
@endsection