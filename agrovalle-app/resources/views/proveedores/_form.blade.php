@php
    $v = fn($campo, $def = '') => old($campo, isset($proveedor) ? $proveedor->$campo : $def);
@endphp

<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label">RTN (14 dígitos)</label>
        <input type="text" name="rtn" maxlength="14" value="{{ $v('rtn') }}"
               class="form-control @error('rtn') is-invalid @enderror">
        @error('rtn')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-8">
        <label class="form-label">Empresa (razón social)</label>
        <input type="text" name="empresa" value="{{ $v('empresa') }}"
               class="form-control @error('empresa') is-invalid @enderror">
        @error('empresa')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Contacto (asesor comercial)</label>
        <input type="text" name="contacto" value="{{ $v('contacto') }}"
               class="form-control @error('contacto') is-invalid @enderror">
        @error('contacto')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Teléfono (8 dígitos)</label>
        <input type="text" name="telefono" maxlength="8" value="{{ $v('telefono') }}"
               class="form-control @error('telefono') is-invalid @enderror">
        @error('telefono')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Categoría</label>
        <select name="categoria" class="form-select @error('categoria') is-invalid @enderror">
            <option value="">Seleccione...</option>
            @foreach($categorias as $c)
                <option value="{{ $c }}" @selected($v('categoria') === $c)>{{ $c }}</option>
            @endforeach
        </select>
        @error('categoria')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Límite de crédito (L.)</label>
        <input type="number" step="0.01" min="0" name="limite_credito" value="{{ $v('limite_credito', 0) }}"
               class="form-control @error('limite_credito') is-invalid @enderror">
        @error('limite_credito')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Días de crédito</label>
        <select name="dias_credito" class="form-select @error('dias_credito') is-invalid @enderror">
            <option value="">Seleccione...</option>
            @foreach($diasCredito as $d)
                <option value="{{ $d }}" @selected((string) $v('dias_credito') === (string) $d)>{{ $d }} días</option>
            @endforeach
        </select>
        @error('dias_credito')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Estado</label>
        <select name="estado" class="form-select @error('estado') is-invalid @enderror">
            @foreach(['Activo', 'Inactivo'] as $e)
                <option value="{{ $e }}" @selected($v('estado', 'Activo') === $e)>{{ $e }}</option>
            @endforeach
        </select>
        @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Fecha de registro</label>
        <input type="date" name="fecha_registro"
               value="{{ old('fecha_registro', isset($proveedor) ? $proveedor->fecha_registro->format('Y-m-d') : date('Y-m-d')) }}"
               class="form-control @error('fecha_registro') is-invalid @enderror">
        @error('fecha_registro')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>