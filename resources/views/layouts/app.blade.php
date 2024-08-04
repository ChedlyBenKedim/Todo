<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maison du Web - @yield('title', 'Accueil')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .navbar-nav .nav-link.sign-up {
            color: #fff;
            background-color: #007bff;
            border-radius: 5px;
            padding: 5px 10px;
            position: relative;
            transition: background-color 0.3s ease;
        }
        .navbar-nav .nav-link.sign-up:hover {
            background-color: #0056b3;
            text-decoration: none;
        }
        .arrow {
            position: absolute;
            top: 50%;
            left: -30px;
            transform: translateY(-50%);
            font-size: 20px;
            color: #007bff;
            animation: blink 1s infinite;
        }
        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }
        .navbar-brand {
            display: flex;
            align-items: center;
        }
        .navbar-brand img {
            height: 40px; /* Ajustez la hauteur du logo si nécessaire */
        }
        .navbar-brand h1 {
            margin-left: 10px;
            font-size: 24px; /* Ajustez la taille du texte si nécessaire */
            color: #007bff; /* Couleur du texte */
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <span class="navbar-brand">
        <img src="{{ asset('images/logo.png') }}" alt="Logo MDW">
        <h1 class="mb-0">MaisonDuWeb</h1>
    </span>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/tasks') }}">Tâches</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/statistics') }}">Statistiques</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            @guest
                <li class="nav-item">
                    <a class="nav-link sign-up" href="{{ url('/register') }}">
                        <span class="arrow">&#9654;</span> Inscription
                    </a>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>
</body>
</html>
