@extends('layouts.app')

@section('title', 'Пости про F1')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-newspaper"></i> Останні пости</h2>
            @auth
                <a href="{{ route('posts.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Створити пост
                </a>
            @endauth
        </div>

        @forelse($posts as $post)
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="mb-1">
                                <a href="{{ route('posts.show', $post) }}" class="text-decoration-none text-white">
                                    {{ $post->title }}
                                </a>
                            </h5>
                            <small class="text-muted">
                                <i class="fas fa-user"></i> 
                                <a href="{{ route('users.profile', $post->user) }}" class="text-decoration-none text-muted">
                                    {{ $post->user->name }}
                                </a>
                                <i class="fas fa-clock ms-2"></i> {{ $post->created_at->diffForHumans() }}
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
                    <p class="card-text">{{ $post->excerpt ?: Str::limit(strip_tags($post->content), 200) }}</p>
                    
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
                    <p class="text-muted">Будьте першим, хто поділиться новинами про F1!</p>
                    @auth
                        <a href="{{ route('posts.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Створити перший пост
                        </a>
                    @endauth
                </div>
            </div>
        @endforelse

        <!-- Пагінація -->
        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6><i class="fas fa-trophy"></i> Топ авторів</h6>
            </div>
            <div class="card-body">
                @php
                    $topUsers = \App\Models\User::orderBy('karma', 'desc')->take(5)->get();
                @endphp
                @foreach($topUsers as $index => $user)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <span class="badge bg-secondary me-2">{{ $index + 1 }}</span>
                            <a href="{{ route('users.profile', $user) }}" class="text-decoration-none">
                                {{ $user->name }}
                            </a>
                        </div>
                        <span class="text-muted">{{ $user->karma }}</span>
                    </div>
                @endforeach
                <hr>
                <a href="{{ route('leaderboard') }}" class="btn btn-outline-primary btn-sm w-100">
                    Переглянути всіх
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
