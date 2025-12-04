@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="auth-card">
    <div class="auth-header">
        <i class="bi bi-book" style="font-size: 48px;"></i>
        <h2>Perpustakaan</h2>
        <p>Sistem Peminjaman Buku</p>
    </div>
    
    <div class="auth-body">
        <h4 class="text-center mb-4">Masuk ke Akun Anda</h4>
        
        @if($errors->any())
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-circle me-2"></i>
            {{ $errors->first() }}
        </div>
        @endif
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="email@example.com" value="{{ old('email') }}" required autofocus>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
            </div>
            
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                <label class="form-check-label" for="remember">Ingat Saya</label>
            </div>
            
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
            </button>
        </form>
        
        <div class="text-center mt-4">
            <p class="text-muted mb-0">Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none">Daftar</a></p>
        </div>
        
        <hr class="my-4">
        
        <div class="text-center">
            <small class="text-muted">Demo Accounts:</small><br>
            <small class="text-muted">Admin: admin@perpustakaan.com</small><br>
            <small class="text-muted">Librarian: librarian@perpustakaan.com</small><br>
            <small class="text-muted">Password: password</small>
        </div>
    </div>
</div>
@endsection
