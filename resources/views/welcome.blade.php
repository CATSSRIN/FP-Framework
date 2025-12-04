<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perpustakaan - Peminjaman Buku</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #435ebe;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
        }
        
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .hero-content {
            color: #fff;
        }
        
        .hero-content h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .hero-content p {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }
        
        .btn-hero {
            padding: 12px 30px;
            font-size: 1rem;
            border-radius: 50px;
            margin-right: 10px;
        }
        
        .btn-primary-hero {
            background: #fff;
            color: #667eea;
            border: none;
        }
        
        .btn-primary-hero:hover {
            background: #f8f9fa;
            color: #667eea;
        }
        
        .btn-outline-hero {
            background: transparent;
            color: #fff;
            border: 2px solid #fff;
        }
        
        .btn-outline-hero:hover {
            background: #fff;
            color: #667eea;
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        .feature-icon i {
            font-size: 36px;
            color: #fff;
        }
        
        .features-section {
            padding: 80px 0;
        }
        
        .illustration {
            max-width: 100%;
            height: auto;
        }
        
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <h1><i class="bi bi-book"></i> Sistem Perpustakaan</h1>
                    <p>Solusi modern untuk manajemen peminjaman buku perpustakaan. Kelola koleksi buku, data anggota, dan transaksi peminjaman dengan mudah dan efisien.</p>
                    
                    <div class="mb-4">
                        @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-hero btn-primary-hero">
                            <i class="bi bi-grid me-2"></i>Dashboard
                        </a>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-hero btn-primary-hero">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-hero btn-outline-hero">
                            <i class="bi bi-person-plus me-2"></i>Daftar
                        </a>
                        @endauth
                    </div>
                    
                    <div class="row mt-5">
                        <div class="col-4 text-center">
                            <div class="feature-icon mx-auto">
                                <i class="bi bi-book"></i>
                            </div>
                            <h5>Kelola Buku</h5>
                        </div>
                        <div class="col-4 text-center">
                            <div class="feature-icon mx-auto">
                                <i class="bi bi-people"></i>
                            </div>
                            <h5>Data Anggota</h5>
                        </div>
                        <div class="col-4 text-center">
                            <div class="feature-icon mx-auto">
                                <i class="bi bi-arrow-left-right"></i>
                            </div>
                            <h5>Peminjaman</h5>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 d-none d-lg-block text-center">
                    <svg class="illustration" viewBox="0 0 400 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="50" y="100" width="300" height="150" rx="10" fill="rgba(255,255,255,0.1)" stroke="rgba(255,255,255,0.3)" stroke-width="2"/>
                        <rect x="70" y="120" width="40" height="110" rx="5" fill="rgba(255,255,255,0.2)"/>
                        <rect x="120" y="130" width="40" height="100" rx="5" fill="rgba(255,255,255,0.3)"/>
                        <rect x="170" y="110" width="40" height="120" rx="5" fill="rgba(255,255,255,0.25)"/>
                        <rect x="220" y="140" width="40" height="90" rx="5" fill="rgba(255,255,255,0.2)"/>
                        <rect x="270" y="125" width="40" height="105" rx="5" fill="rgba(255,255,255,0.35)"/>
                        <circle cx="200" cy="60" r="30" fill="rgba(255,255,255,0.15)" stroke="rgba(255,255,255,0.4)" stroke-width="2"/>
                        <path d="M190 60 L200 50 L210 60 L200 70 Z" fill="rgba(255,255,255,0.5)"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
