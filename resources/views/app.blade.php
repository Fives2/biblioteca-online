<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Online</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: white;
        }
        .nav-link {
            color: #adb5bd;
        }
        .nav-link:hover, .nav-link.active {
            color: white;
            background-color: #495057;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 sidebar p-3">
            <h4 class="mb-4 text-center">Biblioteca</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                        <i class="bi bi-house"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('books.index') }}" class="nav-link {{ request()->is('books*') ? 'active' : '' }}">
                        <i class="bi bi-book"></i> Livros
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('authors.index') }}" class="nav-link {{ request()->is('authors*') ? 'active' : '' }}">
                        <i class="bi bi-person"></i> Autores
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link {{ request()->is('categories*') ? 'active' : '' }}">
                        <i class="bi bi-tags"></i> Categorias
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('loans.index') }}" class="nav-link {{ request()->is('loans*') ? 'active' : '' }}">
                        <i class="bi bi-arrow-left-right"></i> Empréstimos
                    </a>
                </li>
            </ul>
        </div>

        <!-- Conteúdo Principal -->
        <div class="col-md-9 col-lg-10 p-4">
            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>