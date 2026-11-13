@php
    $v = fn($campo, $def = '') => old($campo, isset($empleado) ? $empleado->$campo : $def);
@endphp

<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label">Identidad (13 digitos, sin guiones)</label>
        <input type="text" name="identidad" maxlength="13" value="{{ $v('identidad') }}"
               class="form-control @error('identidad') is-invalid @enderror">
        @error('identidad')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" value="{{ $v('nombre') }}"
               class="form-control @error('nombre') is-invalid @enderror">
        @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Apellido</label>
        <input type="text" name="apellido" value="{{ $v('apellido') }}"
               class="form-control @error('apellido') is-invalid @enderror">
        @error('apellido')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Correo</label>
        <input type="email" name="correo" value="{{ $v('correo') }}"
               class="form-control @error('correo') is-invalid @enderror">
        @error('correo')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Cargo</label>
        <select name="cargo" class="form-select @error('cargo') is-invalid @enderror">
            <option value="">Seleccione...</option>
            @foreach($cargos as $c)
                <option value="{{ $c }}" @selected($v('cargo') === $c)>{{ $c }}</option>
            @endforeach
        </select>
        @error('cargo')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Salario base mensual (L.)</label>
        <input type="number" step="0.01" min="0.01" name="salario" value="{{ $v('salario') }}"
               class="form-control @error('salario') is-invalid @enderror">
        @error('salario')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Fecha de ingreso</label>
        <input type="date" name="fecha_ingreso" max="{{ date('Y-m-d') }}"
               value="{{ old('fecha_ingreso', isset($empleado) ? $empleado->fecha_ingreso->format('Y-m-d') : '') }}"
               class="form-control @error('fecha_ingreso') is-invalid @enderror">
        @error('fecha_ingreso')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Estado</label>
        <select name="estado" class="form-select @error('estado') is-invalid @enderror">
            @foreach(['Activo', 'Inactivo'] as $e)
                <option value="{{ $e }}" @selected($v('estado', 'Activo') === $e)>{{ $e }}</option>
            @endforeach
        </select>
        @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>