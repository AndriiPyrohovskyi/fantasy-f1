@extends('layouts.app')

@section('title', 'Редагувати профіль')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-edit"></i> Редагувати профіль</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="name" class="form-label">Ім'я</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="bio" class="form-label">Про себе</label>
                                <textarea class="form-control @error('bio') is-invalid @enderror" 
                                          id="bio" name="bio" rows="4" 
                                          placeholder="Розкажіть про себе...">{{ old('bio', $user->bio) }}</textarea>
                                @error('bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="avatar" class="form-label">Аватар</label>
                                <div class="text-center mb-3">
                                    @if($user->avatar)
                                        <img src="{{ Storage::url($user->avatar) }}" 
                                             class="rounded-circle mb-2" width="100" height="100" alt="Avatar">
                                    @else
                                        <div class="bg-secondary rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" 
                                             style="width: 100px; height: 100px;">
                                            <i class="fas fa-user fa-2x"></i>
                                        </div>
                                    @endif
                                </div>
                                <input type="file" class="form-control @error('avatar') is-invalid @enderror" 
                                       id="avatar" name="avatar" accept="image/*">
                                <div class="form-text">JPG, PNG, GIF до 2MB</div>
                                @error('avatar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h5>Змінити пароль</h5>
                    <p class="text-muted small">Залиште пустим, якщо не хочете змінювати пароль</p>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Новий пароль</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Підтвердіть пароль</label>
                                <input type="password" class="form-control" 
                                       id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('profile') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Скасувати
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Зберегти зміни
                        </button>
                    </div>
                </form>

                <hr>

                <div class="text-center">
                    <h6 class="text-danger">Зона небезпеки</h6>
                    <p class="text-muted small">Видалення акаунту незворотне</p>
                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" 
                                onclick="return confirm('Ви впевнені? Цю дію не можна скасувати!')">
                            <i class="fas fa-trash"></i> Видалити акаунт
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
