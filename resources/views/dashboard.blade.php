@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">{{ $stats['total_books'] }}</h2>
                    <span>Total Buku</span>
                </div>
                <i class="bi bi-book" style="font-size: 48px; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="stat-card purple">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">{{ $stats['total_members'] }}</h2>
                    <span>Total Anggota</span>
                </div>
                <i class="bi bi-people" style="font-size: 48px; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="stat-card green">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">{{ $stats['active_loans'] }}</h2>
                    <span>Peminjaman Aktif</span>
                </div>
                <i class="bi bi-arrow-left-right" style="font-size: 48px; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="stat-card orange">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">{{ $stats['total_categories'] }}</h2>
                    <span>Total Kategori</span>
                </div>
                <i class="bi bi-folder" style="font-size: 48px; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="stat-card red">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">{{ $stats['overdue_loans'] }}</h2>
                    <span>Terlambat</span>
                </div>
                <i class="bi bi-exclamation-triangle" style="font-size: 48px; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #00b09b, #96c93d);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">{{ $stats['returned_today'] }}</h2>
                    <span>Dikembalikan Hari Ini</span>
                </div>
                <i class="bi bi-check-circle" style="font-size: 48px; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Loans -->
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Peminjaman Terbaru</h5>
                @if(auth()->user()->role !== 'member')
                <a href="{{ route('loans.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
                @endif
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Buku</th>
                                <th>Anggota</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentLoans as $loan)
                            <tr>
                                <td>{{ Str::limit($loan->book->title, 25) }}</td>
                                <td>{{ $loan->member->name }}</td>
                                <td>
                                    @if($loan->status === 'borrowed')
                                    <span class="badge bg-primary">Dipinjam</span>
                                    @elseif($loan->status === 'returned')
                                    <span class="badge bg-success">Dikembalikan</span>
                                    @else
                                    <span class="badge bg-danger">Terlambat</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">Belum ada data peminjaman</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Overdue Loans -->
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-exclamation-triangle me-2 text-danger"></i>Peminjaman Terlambat</h5>
                @if(auth()->user()->role !== 'member')
                <a href="{{ route('loans.index') }}?status=overdue" class="btn btn-sm btn-danger">Lihat Semua</a>
                @endif
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Buku</th>
                                <th>Anggota</th>
                                <th>Jatuh Tempo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($overdueLoans as $loan)
                            <tr>
                                <td>{{ Str::limit($loan->book->title, 25) }}</td>
                                <td>{{ $loan->member->name }}</td>
                                <td><span class="text-danger">{{ $loan->due_date->format('d M Y') }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">Tidak ada peminjaman terlambat</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Popular Books -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-star me-2 text-warning"></i>Buku Populer</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Judul Buku</th>
                                <th>Penulis</th>
                                <th>Total Dipinjam</th>
                                <th>Stok Tersedia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($popularBooks as $index => $book)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td><span class="badge bg-info">{{ $book->loans_count }} kali</span></td>
                                <td><span class="badge {{ $book->available_stock > 0 ? 'bg-success' : 'bg-danger' }}">{{ $book->available_stock }}/{{ $book->stock }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Belum ada data buku</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
