@extends('layouts.app')

@section('title', 'Лідерборд')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-trophy"></i> Лідерборд F1 Blog</h3>
                <p class="mb-0 text-muted">Рейтинг користувачів по кармі</p>
            </div>
            <div class="card-body">
                @forelse($users as $index => $user)
                    <div class="d-flex align-items-center mb-3 p-3 rounded @if($index < 3) bg-dark @endif">
                        <div class="me-3">
                            @if($index === 0)
                                <span class="badge bg-warning text-dark fs-5">
                                    <i class="fas fa-crown"></i> 1
                                </span>
                            @elseif($index === 1)
                                <span class="badge bg-secondary fs-5">
                                    <i class="fas fa-medal"></i> 2
                                </span>
                            @elseif($index === 2)
                                <span class="badge bg-warning text-dark fs-5">
                                    <i class="fas fa-medal"></i> 3
                                </span>
                            @else
                                <span class="badge bg-primary fs-6">{{ $index + 1 }}</span>
                            @endif
                        </div>
                        
                        <div class="me-3">
                            @if($user->avatar)
                                <img src="{{ Storage::url($user->avatar) }}" 
                                     class="rounded-circle" width="50" height="50" alt="Avatar">
                            @else
                                <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 50px; height: 50px;">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                        </div>
                        
                        <div class="flex-grow-1">
                            <h6 class="mb-1">
                                <a href="{{ route('users.profile', $user) }}" 
                                   class="text-decoration-none text-white">
                                    {{ $user->name }}
                                </a>
                                @if($user->isAdmin())
                                    <span class="badge bg-danger ms-2">
                                        <i class="fas fa-shield-alt"></i> Адмін
                                    </span>
                                @endif
                            </h6>
                            @if($user->bio)
                                <p class="text-muted small mb-0">{{ Str::limit($user->bio, 100) }}</p>
                            @endif
                            <small class="text-muted">
                                <i class="fas fa-newspaper"></i> Постів: {{ $user->posts()->count() }}
                            </small>
                        </div>
                        
                        <div class="text-end">
                            <div class="h5 mb-0 text-warning">
                                <i class="fas fa-star"></i> {{ $user->karma }}
                            </div>
                            <small class="text-muted">карма</small>
                        </div>
                    </div>
                    
                    @if($index < count($users) - 1)
                        <hr class="my-2">
                    @endif
                @empty
                    <div class="text-center py-5">
                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                        <h5>Поки що немає користувачів</h5>
                        <p class="text-muted">Будьте першим, хто приєднається до спільноти!</p>
                        @guest
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                <i class="fas fa-user-plus"></i> Зареєструватися
                            </a>
                        @endguest
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
