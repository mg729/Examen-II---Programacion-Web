<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email', 'regex:/@agrovalle\.hn$/i'],
            'password' => ['required'],
        ], [
            'email.required'    => 'El correo es obligatorio.',
            'email.email'       => 'Ingrese un correo válido.',
            'email.regex'       => 'Debe usar su correo institucional (@agrovalle.hn).',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        // Credenciales válidas: regenerar sesión (evita fijación de sesión)
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        // Fallo: volver conservando el correo ingresado
        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Las credenciales no coinciden con nuestros registros.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();       // invalida la sesión
        $request->session()->regenerateToken();  // nuevo token CSRF
        return redirect()->route('login');
    }
}