<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedor::orderBy('empresa')->paginate(10);
        return view('proveedores.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */ 
    public function create()
    {
        return view('proveedores.create', $this->listas());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->validate($this->reglas(), $this->mensajes());
        Proveedor::create($datos);

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedor)
    {
        return view('proveedores.edit', ['proveedor' => $proveedor] + $this->listas());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        $datos = $request->validate($this->reglas($proveedor->id), $this->mensajes());
        $proveedor->update($datos);

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor eliminado correctamente.');
    }

    /*
     * Privados
     */
    private function listas(): array
    {
        return [
            'categorias'  => Proveedor::CATEGORIAS,
            'diasCredito' => Proveedor::DIAS_CREDITO,
        ];
    }

    private function reglas(?int $id = null): array
    {
        return [
            'rtn'            => ['required', 'digits:14', Rule::unique('proveedores', 'rtn')->ignore($id)],
            'empresa'        => ['required', 'string', 'max:150'],
            'contacto'       => ['required', 'string', 'max:100'],
            'telefono'       => ['required', 'regex:/^[2389][0-9]{7}$/'],
            'categoria'      => ['required', Rule::in(Proveedor::CATEGORIAS)],
            'limite_credito' => ['required', 'numeric', 'min:0'],
            'dias_credito'   => ['required', 'integer', Rule::in(Proveedor::DIAS_CREDITO)],
            'estado'         => ['required', Rule::in(['Activo', 'Inactivo'])],
            'fecha_registro' => ['required', 'date'],
        ];
    }

    private function mensajes(): array
    {
        return [
            'rtn.required'         => 'El RTN es obligatorio.',
            'rtn.digits'           => 'El RTN debe tener exactamente 14 dígitos numéricos.',
            'rtn.unique'           => 'Este RTN ya está registrado.',
            'telefono.regex'       => 'El teléfono debe tener 8 dígitos y comenzar con 2, 3, 8 o 9.',
            'limite_credito.min'   => 'El límite de crédito no puede ser negativo.',
            'dias_credito.in'      => 'Seleccione 15, 30, 45 o 60 días.',
            'required'             => 'Este campo es obligatorio.',
        ];
    }

}
