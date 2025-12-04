@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-folder me-2"></i>Informasi Kategori</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="120">Nama</th>
                        <td>{{ $category->name }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $category->description ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Buku</th>
                        <td><span class="badge bg-info">{{ $category->books->count() }} buku</span></td>
                    </tr>
                    <tr>
                        <th>Dibuat</th>
                        <td>{{ $category->created_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>
                
                <div class="d-flex gap-2">
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-1"></i>Edit
                    </a>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-book me-2"></i>Buku dalam Kategori Ini</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($category->books as $index => $book)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>
                                    <span class="badge {{ $book->available_stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $book->available_stock }}/{{ $book->stock }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    Belum ada buku dalam kategori ini
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
