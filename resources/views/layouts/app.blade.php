<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RS.success — Centre de Soutien Scolaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #F8F9FA; }
        .navbar { background-color: #1A3C5E; }
        .navbar-brand, .nav-link { color: #ffffff !important; }
        .nav-link:hover { color: #F5A623 !important; }
        .btn-primary { background-color: #4A90D9; border-color: #4A90D9; }
        .btn-warning { background-color: #F5A623; border-color: #F5A623; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">RS.success</a>
        <div class="collapse navbar-collapse">

            @if(session('admin'))
            {{-- NAVBAR ADMIN --}}
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/admin/inscriptions">Inscriptions</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/activites">Activités</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/cours">Cours</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/salles">Salles</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/plannings">Planning</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/eleves">Élèves</a></li>
                <li class="nav-item">
                    <form action="/admin/logout" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-outline-warning btn-sm ms-2">Déconnexion</button>
                    </form>
                </li>
            </ul>
            @else
            {{-- NAVBAR PUBLIC --}}
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/cours">Cours</a></li>
                <li class="nav-item"><a class="nav-link" href="/activites">Activités</a></li>
                <li class="nav-item"><a class="nav-link" href="/inscriptions/create">S'inscrire</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/login">Admin</a></li>
            </ul>
            @endif

        </div>
    </div>
</nav>

<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>