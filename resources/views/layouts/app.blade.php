<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'F1 Blog')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --f1-red: #FF1E00;
            --f1-dark: #15151E;
            --f1-silver: #C0C0C0;
            --f1-white: #FFFFFF;
        }
        
        body {
            background-color: var(--f1-dark);
            color: var(--f1-white);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background-color: var(--f1-red) !important;
            box-shadow: 0 2px 10px rgba(255, 30, 0, 0.3);
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        
        .navbar-nav .nav-link {
            color: var(--f1-white) !important;
            font-weight: 500;
            transition: opacity 0.3s;
        }
        
        .navbar-nav .nav-link:hover {
            opacity: 0.8;
        }
        
        .btn-primary {
            background-color: var(--f1-red);
            border-color: var(--f1-red);
        }
        
        .btn-primary:hover {
            background-color: #d41600;
            border-color: #d41600;
        }
        
        .card {
            background-color: #2a2a3a;
            border: 1px solid #3a3a4a;
            color: var(--f1-white);
        }
        
        .card-header {
            background-color: #333344;
            border-bottom: 1px solid #3a3a4a;
        }
        
        .text-muted {
            color: var(--f1-silver) !important;
        }
        
        .like-btn {
            background: none;
            border: none;
            color: var(--f1-silver);
            cursor: pointer;
            transition: color 0.3s;
        }
        
        .like-btn.liked {
            color: var(--f1-red);
        }
        
        .like-btn:hover {
            color: var(--f1-red);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-flag-checkered"></i> F1 Blog
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home"></i> Головна
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.index') }}">
                            <i class="fas fa-newspaper"></i> Пости
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('leaderboard') }}">
                            <i class="fas fa-trophy"></i> Лідерборд
                        </a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Профіль</a></li>
                                <li><a class="dropdown-item" href="{{ route('posts.create') }}">Створити пост</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Вийти</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> Увійти
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i> Реєстрація
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-5 py-4 text-center" style="background-color: #1a1a2e;">
        <div class="container">
            <p class="text-muted mb-0">
                <i class="fas fa-flag-checkered"></i> F1 Blog &copy; {{ date('Y') }}. Всі права захищені.
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Функція для лайків
        function toggleLike(postId) {
            fetch(`/posts/${postId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                    return;
                }
                
                const likeBtn = document.querySelector(`#like-btn-${postId}`);
                const likeCount = document.querySelector(`#like-count-${postId}`);
                
                if (data.liked) {
                    likeBtn.classList.add('liked');
                } else {
                    likeBtn.classList.remove('liked');
                }
                
                likeCount.textContent = data.likes_count;
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
    
    @stack('scripts')
</body>
</html>
