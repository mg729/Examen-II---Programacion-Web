@extends('layouts.app')
@section('title', 'Editar Insumo')
@section('content')
<div class="card shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('insumos.update', $insumo) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('insumos._form')
        <div class="mt-4">
            <button class="btn btn-primary"><i class="bi bi-save"></i> Actualizar</button>
            <a href="{{ route('insumos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div></div>
@endsection