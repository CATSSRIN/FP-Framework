@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-body text-center">
                @if($book->cover_image)
                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover" class="img-fluid rounded mb-3" style="max-height: 300px;">
                @else
                <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3" style="height: 300px;">
                    <i class="bi bi-book" style="font-size: 100px; color: #ccc;"></i>
                </div>
                @endif
                
                <h4>{{ $book->title }}</h4>
                <p class="text-muted">{{ $book->author }}</p>
                
                <div class="d-flex justify-content-center gap-2 mb-3">
                    <span class="badge {{ $book->available_stock > 0 ? 'bg-success' : 'bg-danger' }} fs-6">
                        {{ $book->available_stock > 0 ? 'Tersedia' : 'Tidak Tersedia' }}
                    </span>
                </div>
                
                <div class="d-flex gap-2 justify-content-center">
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-1"></i>Edit
                    </a>
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Informasi Buku</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="130">Kategori</th>
                                <td><span class="badge bg-primary">{{ $book->category->name }}</span></td>
                            </tr>
                            <tr>
                                <th>ISBN</th>
                                <td>{{ $book->isbn ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Penerbit</th>
                                <td>{{ $book->publisher ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Tahun Terbit</th>
                                <td>{{ $book->publication_year ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="130">Total Stok</th>
                                <td>{{ $book->stock }} eksemplar</td>
                            </tr>
                            <tr>
                                <th>Tersedia</th>
                                <td><span class="badge {{ $book->available_stock > 0 ? 'bg-success' : 'bg-danger' }}">{{ $book->available_stock }} eksemplar</span></td>
                            </tr>
                            <tr>
                                <th>Dipinjam</th>
                                <td>{{ $book->stock - $book->available_stock }} eksemplar</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                @if($book->description)
                <hr>
                <h6>Deskripsi</h6>
                <p class="text-muted">{{ $book->description }}</p>
                @endif
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Riwayat Peminjaman</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Anggota</th>
                                <th>Tanggal Pinjam</th>
                                <th>Jatuh Tempo</th>
                                <th>Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($book->loans as $loan)
                            <tr>
                                <td>{{ $loan->member->name }}</td>
                                <td>{{ $loan->loan_date->format('d M Y') }}</td>
                                <td>{{ $loan->due_date->format('d M Y') }}</td>
                                <td>{{ $loan->return_date ? $loan->return_date->format('d M Y') : '-' }}</td>
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
                                <td colspan="5" class="text-center py-4 text-muted">
                                    Belum ada riwayat peminjaman
                                </td>
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
