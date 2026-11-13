<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesion | AGROVALLE Honduras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background: linear-gradient(135deg, #1e5631, #4c9a2a); min-height: 100vh; }
        .login-card { max-width: 420px; width: 100%; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center p-3">
    <div class="card shadow-lg login-card">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <img src="{{ asset('img/logo.png') }}" alt="Logo AGROVALLE" height="70">
                <h4 class="mt-2 text-success fw-bold">AGROVALLE HONDURAS</h4>
                <small class="text-muted">Sistema de gestion interna</small>
            </div>

            <form method="POST" action="{{ route('login.post') }}" novalidate>
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Correo Institucional</label>
                    <input type="email" name="email" id="email"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="usuario@agrovalle.hn" value="{{ old('email') }}" autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" id="password"
                           class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Recordar mi sesion</label>
                </div>

                <button class="btn btn-success w-100"><i class="bi bi-box-arrow-in-right"></i> Ingresar</button>
            </form>
        </div>
    </div>
</body>
</html>