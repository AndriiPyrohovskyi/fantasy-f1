@extends('layouts.app')

@section('title', 'Профіль - ' . $user->name)

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                @if($user->avatar)
                    <img src="{{ Storage::url($user->avatar) }}" 
                         class="rounded-circle mb-3" width="120" height="120" alt="Avatar">
                @else
                    <div class="bg-secondary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" 
                         style="width: 120px; height: 120px;">
                        <i class="fas fa-user fa-3x"></i>
                    </div>
                @endif
                
                <h4>{{ $user->name }}</h4>
                @if($user->isAdmin())
                    <span class="badge bg-danger mb-2">
                        <i class="fas fa-shield-alt"></i> Адміністратор
                    </span>
                @endif
                
                @if($user->bio)
                    <p class="text-muted">{{ $user->bio }}</p>
                @endif
                
                <div class="row text-center mb-3">
                    <div class="col">
                        <div class="h5 text-warning mb-0">
                            <i class="fas fa-star"></i> {{ $user->karma }}
                        </div>
                        <small class="text-muted">Карма</small>
                    </div>
                    <div class="col">
                        <div class="h5 mb-0">{{ $user->posts()->count() }}</div>
                        <small class="text-muted">Постів</small>
                    </div>
                    <div class="col">
                        <div class="h5 mb-0">{{ $user->comments()->count() }}</div>
                        <small class="text-muted">Коментарів</small>
                    </div>
                </div>
                
                @auth
                    @if($user->id === Auth::id())
                        <div class="d-grid gap-2">
                            <a href="{{ route('users.edit') }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Редагувати профіль
                            </a>
                            <a href="{{ route('posts.create') }}" class="btn btn-outline-primary">
                                <i class="fas fa-plus"></i> Створити пост
                            </a>
                        </div>
                    @elseif(Auth::user()->isAdmin())
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-grid">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" 
                                    onclick="return confirm('Ви впевнені?')">
                                <i class="fas fa-trash"></i> Видалити користувача
                            </button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4><i class="fas fa-newspaper"></i> Пости користувача</h4>
        </div>
        
        @forelse($posts as $post)
            <div class="card mb-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-1">
                                <a href="{{ route('posts.show', $post) }}" 
                                   class="text-decoration-none text-white">
                                    {{ $post->title }}
                                </a>
                            </h6>
                            <small class="text-muted">
                                <i class="fas fa-clock"></i> {{ $post->created_at->diffForHumans() }}
                            </small>
                        </div>
                        @auth
                            @if($post->user_id === Auth::id() || Auth::user()->isAdmin())
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        @if($post->user_id === Auth::id())
                                            <li><a class="dropdown-item" href="{{ route('posts.edit', $post) }}">
                                                <i class="fas fa-edit"></i> Редагувати
                                            </a></li>
                                        @endif
                                        <li>
                                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" 
                                                        onclick="return confirm('Ви впевнені?')">
                                                    <i class="fas fa-trash"></i> Видалити
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $post->excerpt ?: Str::limit(strip_tags($post->content), 150) }}</p>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <button class="like-btn @if(Auth::check() && $post->isLikedBy(Auth::user())) liked @endif" 
                                    id="like-btn-{{ $post->id }}" 
                                    onclick="toggleLike({{ $post->id }})">
                                <i class="fas fa-heart"></i> <span id="like-count-{{ $post->id }}">{{ $post->likes_count }}</span>
                            </button>
                            <span class="text-muted ms-3">
                                <i class="fas fa-comments"></i> {{ $post->comments_count }}
                            </span>
                        </div>
                        <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-primary btn-sm">
                            Читати далі
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <h5>Поки що немає постів</h5>
                    @if($user->id === Auth::id())
                        <p class="text-muted">Створіть свій перший пост про Formula 1!</p>
                        <a href="{{ route('posts.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Створити пост
                        </a>
                    @else
                        <p class="text-muted">{{ $user->name }} ще не створив(ла) жодного поста.</p>
                    @endif
                </div>
            </div>
        @endforelse
        
        <!-- Пагінація -->
        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
