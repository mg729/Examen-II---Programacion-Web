<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | AGROVALLE Honduras</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background:#f4f6f4; }
        .sidebar { width:250px; min-height:100vh; background:#1e5631; }
        .sidebar .nav-link { color:#d9ead3; padding:.8rem 1.2rem; }
        .sidebar .nav-link:hover { background:#2d7a47; color:#fff; }
        .sidebar .nav-link.active { background:#4c9a2a; color:#fff; font-weight:600; }
        .brand { color:#fff; font-weight:700; padding:1.2rem; border-bottom:1px solid #2d7a47; }
    </style>
    @stack('styles')
</head>
<body>
<div class="d-flex">

    <aside class="sidebar d-flex flex-column">
        <div class="brand text-center">
            <img src="{{ asset('img/logo.jpg') }}" alt="Logo AGROVALLE" height="50" class="mb-2"><br>
            AGROVALLE HONDURAS
        </div>
        <ul class="nav flex-column mt-2">
            <li><a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                   href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
            <li><a class="nav-link {{ request()->routeIs('insumos.*') ? 'active' : '' }}"
                   href="{{ route('insumos.index') }}"><i class="bi bi-box-seam me-2"></i>Insumos</a></li>
            <li><a class="nav-link {{ request()->routeIs('proveedores.*') ? 'active' : '' }}"
                   href="{{ route('proveedores.index') }}"><i class="bi bi-truck me-2"></i>Proveedores</a></li>
            <li><a class="nav-link {{ request()->routeIs('empleados.*') ? 'active' : '' }}"
                   href="{{ route('empleados.index') }}"><i class="bi bi-people me-2"></i>Empleados</a></li>
        </ul>
    </aside>

    <div class="flex-grow-1 d-flex flex-column">
        {{-- Barra superior --}}
        <nav class="navbar bg-white shadow-sm px-4">
            <span class="navbar-text fw-semibold">@yield('title', 'Dashboard')</span>
            <div class="d-flex align-items-center gap-3">
                <span><i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-box-arrow-right"></i> Cerrar sesion
                    </button>
                </form>
            </div>
        </nav>

        <main class="p-4 flex-grow-1">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </main>

        <footer class="bg-white text-center py-3 small text-muted border-top">
            &copy; {{ date('Y') }} Distribuidora Agropecuaria del Valle S. de R.L. (AGROVALLE Honduras)
        </footer>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>