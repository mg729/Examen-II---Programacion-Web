<?php
use App\Http\Controllers\{DashboardController, AuthController, InsumoController, ProveedorController, EmpleadoController};
use Illuminate\Support\Facades\Route;

// Rutas publicas (invitados)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Rutas protegidas
Route::middleware(['auth', \App\Http\Middleware\NoCache::class])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('insumos', InsumoController::class)->except('show');
    Route::resource('proveedores', ProveedorController::class)->except('show')
         ->parameters(['proveedores' => 'proveedor']);
    Route::resource('empleados', EmpleadoController::class)->except('show');
});