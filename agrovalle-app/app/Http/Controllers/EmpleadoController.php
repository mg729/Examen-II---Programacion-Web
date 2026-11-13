<?php
namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::orderBy('apellido')->orderBy('nombre')->paginate(10);
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        return view('empleados.create', ['cargos' => Empleado::CARGOS]);
    }

    public function store(Request $request)
    {
        $datos = $request->validate($this->reglas(), $this->mensajes());
        Empleado::create($datos);

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado registrado correctamente.');
    }

    public function edit(Empleado $empleado)
    {
        return view('empleados.edit', ['empleado' => $empleado, 'cargos' => Empleado::CARGOS]);
    }

    public function update(Request $request, Empleado $empleado)
    {
        $datos = $request->validate($this->reglas($empleado->id), $this->mensajes());
        $empleado->update($datos);

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado actualizado correctamente.');
    }

    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado eliminado correctamente.');
    }

    private function reglas(?int $id = null): array
    {
        return [
            'identidad'     => ['required', 'digits:13', Rule::unique('empleados', 'identidad')->ignore($id)],
            'nombre'        => ['required', 'string', 'max:80'],
            'apellido'      => ['required', 'string', 'max:80'],
            'correo'        => ['required', 'email', 'max:120', Rule::unique('empleados', 'correo')->ignore($id)],
            'cargo'         => ['required', Rule::in(Empleado::CARGOS)],
            'salario'       => ['required', 'numeric', 'gt:0'],
            'fecha_ingreso' => ['required', 'date', 'before_or_equal:today'],
            'estado'        => ['required', Rule::in(['Activo', 'Inactivo'])],
        ];
    }

    private function mensajes(): array
    {
        return [
            'identidad.digits'            => 'La identidad debe tener exactamente 13 dígitos, sin guiones.',
            'identidad.unique'            => 'Esta identidad ya está registrada.',
            'correo.unique'               => 'Este correo ya está registrado.',
            'salario.gt'                  => 'El salario debe ser mayor que 0.',
            'fecha_ingreso.before_or_equal' => 'La fecha de ingreso no puede ser futura.',
            'cargo.required'              => 'Seleccione un cargo.',
            'required'                    => 'Este campo es obligatorio.',
        ];
    }
}