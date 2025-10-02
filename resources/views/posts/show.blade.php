@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h2 class="mb-2">{{ $post->title }}</h2>
                        <div class="text-muted">
                            <i class="fas fa-user"></i>
                            <a href="{{ route('users.profile', $post->user) }}" class="text-decoration-none text-muted">
                                {{ $post->user->name }}
                            </a>
                            <i class="fas fa-clock ms-3"></i> {{ $post->created_at->format('d.m.Y H:i') }}
                        </div>
                    </div>
                    @auth
                        @if($post->user_id === Auth::id() || Auth::user()->isAdmin())
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="dropdown">
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
                <div class="mb-4">
                    {!! nl2br(e($post->content)) !!}
                </div>
                
                <div class="d-flex justify-content-between align-items-center border-top pt-3">
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
                    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Назад до постів
                    </a>
                </div>
            </div>
        </div>

        <!-- Коментарі -->
        <div class="mt-4">
            <h4><i class="fas fa-comments"></i> Коментарі</h4>
            
            @auth
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('posts.comments.store', $post) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <textarea name="content" class="form-control" rows="3" 
                                          placeholder="Напишіть ваш коментар..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Додати коментар
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="alert alert-info">
                    <a href="{{ route('login') }}" class="text-decoration-none">Увійдіть</a>, щоб залишити коментар.
                </div>
            @endauth

            @forelse($post->comments as $comment)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <strong>
                                    <a href="{{ route('users.profile', $comment->user) }}" 
                                       class="text-decoration-none">
                                        {{ $comment->user->name }}
                                    </a>
                                </strong>
                                <small class="text-muted ms-2">
                                    {{ $comment->created_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                        <p class="mb-0">{{ $comment->content }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted py-4">
                    <i class="fas fa-comments fa-3x mb-3"></i>
                    <p>Поки що немає коментарів. Будьте першим!</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="col-md-4">
        <!-- Інформація про автора -->
        <div class="card mb-4">
            <div class="card-header">
                <h6><i class="fas fa-user"></i> Про автора</h6>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    @if($post->user->avatar)
                        <img src="{{ Storage::url($post->user->avatar) }}" 
                             class="rounded-circle" width="80" height="80" alt="Avatar">
                    @else
                        <div class="bg-secondary rounded-circle mx-auto d-flex align-items-center justify-content-center" 
                             style="width: 80px; height: 80px;">
                            <i class="fas fa-user fa-2x"></i>
                        </div>
                    @endif
                </div>
                <h6 class="text-center">{{ $post->user->name }}</h6>
                @if($post->user->bio)
                    <p class="text-muted text-center small">{{ $post->user->bio }}</p>
                @endif
                <div class="text-center">
                    <small class="text-muted">
                        <i class="fas fa-star"></i> Карма: {{ $post->user->karma }}
                    </small>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('users.profile', $post->user) }}" class="btn btn-outline-primary btn-sm">
                        Переглянути профіль
                    </a>
                </div>
            </div>
        </div>

        <!-- Схожі пости -->
        <div class="card">
            <div class="card-header">
                <h6><i class="fas fa-newspaper"></i> Останні пости</h6>
            </div>
            <div class="card-body">
                @php
                    $recentPosts = \App\Models\Post::where('id', '!=', $post->id)
                                                  ->orderBy('created_at', 'desc')
                                                  ->take(5)
                                                  ->get();
                @endphp
                @foreach($recentPosts as $recentPost)
                    <div class="mb-3">
                        <a href="{{ route('posts.show', $recentPost) }}" 
                           class="text-decoration-none">
                            <h6 class="mb-1">{{ Str::limit($recentPost->title, 50) }}</h6>
                        </a>
                        <small class="text-muted">
                            {{ $recentPost->created_at->diffForHumans() }}
                        </small>
                    </div>
                    @if(!$loop->last)<hr>@endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
