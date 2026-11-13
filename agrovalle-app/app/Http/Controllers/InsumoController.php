<?php
namespace App\Http\Controllers;

use App\Models\Insumo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class InsumoController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');

        $insumos = Insumo::when($buscar, function ($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%")
                  ->orWhere('codigo', 'like', "%{$buscar}%");
            })
            ->orderBy('nombre')
            ->paginate(10)
            ->withQueryString();

        return view('insumos.index', compact('insumos', 'buscar'));
    }

    public function create()
    {
        return view('insumos.create', ['categorias' => Insumo::CATEGORIAS]);
    }

    public function store(Request $request)
    {
        $datos = $request->validate($this->reglas());

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $this->guardarImagen($request->file('imagen'));
        }

        Insumo::create($datos);

        return redirect()->route('insumos.index')->with('success', 'Insumo registrado correctamente.');
    }

    public function edit(Insumo $insumo)
    {
        return view('insumos.edit', ['insumo' => $insumo, 'categorias' => Insumo::CATEGORIAS]);
    }

    public function update(Request $request, Insumo $insumo)
    {
        $datos = $request->validate($this->reglas($insumo->id));

        if ($request->hasFile('imagen')) {
            $this->borrarImagen($insumo->imagen);
            $datos['imagen'] = $this->guardarImagen($request->file('imagen'));
        }

        $insumo->update($datos);

        return redirect()->route('insumos.index')->with('success', 'Insumo actualizado correctamente.');
    }

    public function destroy(Insumo $insumo)
    {
        $this->borrarImagen($insumo->imagen);
        $insumo->delete();

        return redirect()->route('insumos.index')->with('success', 'Insumo eliminado correctamente.');
    }

    /* ---------- Métodos privados ---------- */

    private function reglas(?int $id = null): array
    {
        return [
            'codigo'            => ['required', 'string', 'max:30', Rule::unique('insumos', 'codigo')->ignore($id)],
            'nombre'            => ['required', 'string', 'max:150'],
            'categoria'         => ['required', Rule::in(Insumo::CATEGORIAS)],
            'precio'            => ['required', 'numeric', 'gt:0'],
            'costo'             => ['required', 'numeric', 'min:0'],
            'inventario'        => ['required', 'integer', 'min:0'],
            'fabricante'        => ['required', 'string', 'max:120'],
            'fecha_vencimiento' => ['nullable', 'date'],
            'fecha_registro'    => ['required', 'date'],
            'numero_lote'       => ['required', 'string', 'max:50'],
            'imagen'            => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'], // 5 MB
        ];
    }

    private function guardarImagen($archivo): string
    {
        $nombre = Str::uuid() . '.' . $archivo->getClientOriginalExtension();
        $archivo->move(public_path('uploads/insumos'), $nombre);
        return $nombre;
    }

    private function borrarImagen(?string $nombre): void
    {
        if ($nombre) {
            File::delete(public_path('uploads/insumos/' . $nombre));
        }
    }
}