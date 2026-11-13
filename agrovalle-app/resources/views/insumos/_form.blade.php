@php $v = fn($campo, $def = '') => old($campo, $insumo->$campo ?? $def); @endphp

<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label">Código (SKU)</label>
        <input type="text" name="codigo" value="{{ $v('codigo') }}" class="form-control @error('codigo') is-invalid @enderror">
        @error('codigo')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-8">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" value="{{ $v('nombre') }}" class="form-control @error('nombre') is-invalid @enderror">
        @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Categoría</label>
        <select name="categoria" class="form-select @error('categoria') is-invalid @enderror">
            <option value="">Seleccione...</option>
            @foreach($categorias as $cat)
                <option value="{{ $cat }}" @selected($v('categoria') === $cat)>{{ $cat }}</option>
            @endforeach
        </select>
        @error('categoria')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Precio (L.)</label>
        <input type="number" step="0.01" name="precio" value="{{ $v('precio') }}" class="form-control @error('precio') is-invalid @enderror">
        @error('precio')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Costo (L.)</label>
        <input type="number" step="0.01" name="costo" value="{{ $v('costo') }}" class="form-control @error('costo') is-invalid @enderror">
        @error('costo')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Inventario</label>
        <input type="number" name="inventario" value="{{ $v('inventario', 0) }}" class="form-control @error('inventario') is-invalid @enderror">
        @error('inventario')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Fabricante</label>
        <input type="text" name="fabricante" value="{{ $v('fabricante') }}" class="form-control @error('fabricante') is-invalid @enderror">
        @error('fabricante')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Número de lote</label>
        <input type="text" name="numero_lote" value="{{ $v('numero_lote') }}" class="form-control @error('numero_lote') is-invalid @enderror">
        @error('numero_lote')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Fecha de vencimiento</label>
        <input type="date" name="fecha_vencimiento"
               value="{{ old('fecha_vencimiento', isset($insumo) ? $insumo->fecha_vencimiento?->format('Y-m-d') : '') }}"
               class="form-control @error('fecha_vencimiento') is-invalid @enderror">
        @error('fecha_vencimiento')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Fecha de registro</label>
        <input type="date" name="fecha_registro"
               value="{{ old('fecha_registro', isset($insumo) ? $insumo->fecha_registro->format('Y-m-d') : date('Y-m-d')) }}"
               class="form-control @error('fecha_registro') is-invalid @enderror">
        @error('fecha_registro')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label">Fotografía del empaque (jpg, png, webp — máx. 5 MB)</label>
        <input type="file" name="imagen" accept=".jpg,.jpeg,.png,.webp" class="form-control @error('imagen') is-invalid @enderror">
        @error('imagen')<div class="invalid-feedback">{{ $message }}</div>@enderror
        @if(isset($insumo) && $insumo->imagen)
            <img src="{{ asset('uploads/insumos/' . $insumo->imagen) }}" alt="Imagen actual" height="80" class="mt-2 rounded">
        @endif
    </div>
</div>